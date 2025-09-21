<!-- resources/views/customer/products/index.blade.php -->
@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <h2>Produk</h2>
    <form method="GET" action="{{ route('customer.products.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $product->gambar_url) }}" class="card-img-top" alt="{{ $product->nama_produk }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_produk }}</h5>
                        <p class="card-text">{{ Str::limit($product->deskripsi, 100) }}</p>
                        <p class="card-text">Kategori: {{ $product->category->nama_kategori }}</p>
                        <p class="card-text">Harga: Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        <p class="card-text">Stok: {{ $product->stok }}</p>
                        <form action="{{ route('customer.cart.add', $product->product_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection