<!-- resources/views/customer/cart/index.blade.php -->
@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <h2>Keranjang Belanja</h2>
    <form action="{{ route('customer.cart.update') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($products as $product)
                    @php $subtotal = $product->harga * ($cart[$product->product_id]['jumlah'] ?? 0); $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $product->nama_produk }}</td>
                        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td>
                            <input type="number" name="jumlah[{{ $product->product_id }}]" class="form-control" value="{{ $cart[$product->product_id]['jumlah'] ?? 0 }}" min="0">
                        </td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('customer.cart.remove', $product->product_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus dari keranjang?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
        <a href="{{ route('customer.checkout') }}" class="btn btn-success">Checkout</a>
    </form>
@endsection