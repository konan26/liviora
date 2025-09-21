<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Report;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:customer']);
    }

    public function index()
    {
        return view('customer.dashboard');
    }

    // View and Search Products
    public function indexProducts(Request $request)
    {
        $products = Product::when($request->search, function ($query, $search) {
            return $query->where('nama_produk', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
        })->with('category')->get();
        return view('customer.products.index', compact('products'));
    }

    // Cart Management
    public function addToCart(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        $cart = session()->get('cart', []);
        $cart[$product_id] = [
            'product_id' => $product_id,
            'jumlah' => ($cart[$product_id]['jumlah'] ?? 0) + 1,
        ];
        session()->put('cart', $cart);
        return redirect()->route('customer.cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function indexCart()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('product_id', array_keys($cart))->get();
        return view('customer.cart.index', compact('cart', 'products'));
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        foreach ($request->input('jumlah', []) as $product_id => $jumlah) {
            if ($jumlah > 0) {
                $cart[$product_id]['jumlah'] = $jumlah;
            } else {
                unset($cart[$product_id]);
            }
        }
        session()->put('cart', $cart);
        return redirect()->route('customer.cart.index')->with('success', 'Keranjang diperbarui.');
    }

    public function removeFromCart($product_id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product_id]);
        session()->put('cart', $cart);
        return redirect()->route('customer.cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    // Checkout
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.cart.index')->with('error', 'Keranjang kosong.');
        }

        $total_harga = 0;
        foreach ($cart as $item) {
            $product = Product::findOrFail($item['product_id']);
            $total_harga += $product->harga * $item['jumlah'];
            if ($product->stok < $item['jumlah']) {
                return redirect()->route('customer.cart.index')->with('error', "Stok {$product->nama_produk} tidak cukup.");
            }
        }

        $order = Order::create([
            'user_id' => auth()->user()->user_id,
            'total_harga' => $total_harga,
            'status_order' => 'pending',
            'tanggal_order' => now(),
        ]);

        foreach ($cart as $item) {
            $product = Product::findOrFail($item['product_id']);
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item['product_id'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $product->harga,
            ]);
            $product->decrement('stok', $item['jumlah']);
        }

        session()->forget('cart');
        return redirect()->route('customer.orders.index')->with('success', 'Pesanan dibuat.');
    }

    // View Orders
    public function indexOrders()
    {
        $orders = Order::where('user_id', auth()->user()->user_id)->with('items.product')->get();
        return view('customer.orders.index', compact('orders'));
    }

    // Write Reports
    public function indexReports()
    {
        $reports = Report::where('user_id', auth()->user()->user_id)->with('responses')->get();
        return view('customer.reports.index', compact('reports'));
    }

    public function createReport(Request $request)
    {
        $validated = $request->validate([
            'isi_laporan' => 'required|string',
        ]);

        Report::create([
            'user_id' => auth()->user()->user_id,
            'isi_laporan' => $validated['isi_laporan'],
            'status' => 'pending',
            'tanggal_lapor' => now(),
        ]);

        return redirect()->route('customer.reports.index')->with('success', 'Laporan dikirim.');
    }
}