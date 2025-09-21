<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Report;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:staff']);
    }

    public function index()
    {
        return view('seller.dashboard');
    }

    // Register Other Sellers
    public function indexUsers()
    {
        $users = User::where('role', 'staff')->get();
        return view('seller.users.index', compact('users'));
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password_hash' => Hash::make($validated['password']),
            'no_hp' => $validated['no_hp'],
            'role' => 'staff', // Only register sellers
            'status' => 'aktif',
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('seller.users.index')->with('success', 'Seller ditambahkan.');
    }

    // Manage Own Products
    public function indexProducts()
    {
        $products = Product::where('user_id', auth()->user()->user_id)->with('category')->get();
        return view('seller.products.index', compact('products'));
    }

    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:categories,kategori_id',
            'gambar_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('gambar_url')->store('products', 'public');
        Product::create(array_merge($validated, [
            'gambar_url' => $path,
            'user_id' => auth()->user()->user_id
        ]));
        return redirect()->route('seller.products.index')->with('success', 'Produk ditambahkan.');
    }

    public function updateProduct(Request $request, $product_id)
    {
        $product = Product::where('user_id', auth()->user()->user_id)->findOrFail($product_id);
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:categories,kategori_id',
            'gambar_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar_url')) {
            $path = $request->file('gambar_url')->store('products', 'public');
            $validated['gambar_url'] = $path;
        } else {
            unset($validated['gambar_url']);
        }

        $product->update($validated);
        return redirect()->route('seller.products.index')->with('success', 'Produk diperbarui.');
    }

    public function deleteProduct($product_id)
    {
        $product = Product::where('user_id', auth()->user()->user_id)->findOrFail($product_id);
        $product->delete();
        return redirect()->route('seller.products.index')->with('success', 'Produk dihapus.');
    }

    // Verify Orders
    public function indexOrders()
    {
        $orders = Order::with('items.product', 'user')->get();
        return view('seller.orders.index', compact('orders'));
    }

    public function verifyOrder(Request $request, $order_id)
    {
        $validated = $request->validate([
            'status_order' => 'required|in:pending,paid,shipped,done,cancelled',
        ]);

        Order::findOrFail($order_id)->update(['status_order' => $validated['status_order']]);
        return redirect()->route('seller.orders.index')->with('success', 'Status pesanan diperbarui.');
    }

    // Respond to Reports
    public function indexReports()
    {
        $reports = Report::with('user', 'responses')->get();
        return view('seller.reports.index', compact('reports'));
    }

    public function respond(Request $request, $report_id)
    {
        $validated = $request->validate([
            'isi_tanggapan' => 'required|string',
            'status' => 'required|in:pending,diverifikasi,ditolak',
        ]);

        Report::findOrFail($report_id)->update(['status' => $validated['status']]);
        Response::create([
            'report_id' => $report_id,
            'user_id' => auth()->user()->user_id,
            'isi_tanggapan' => $validated['isi_tanggapan'],
            'tanggal_reply' => now(),
        ]);

        return redirect()->route('seller.reports.index')->with('success', 'Tanggapan dikirim.');
    }
}