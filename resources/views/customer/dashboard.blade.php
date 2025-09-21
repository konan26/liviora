<!-- resources/views/customer/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard Pelanggan')

@section('content')
    <h2>Dashboard Pelanggan</h2>
    <p>Selamat datang, {{ Auth::user()->nama_lengkap }}!</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produk</h5>
                    <p class="card-text">Lihat dan cari produk.</p>
                    <a href="{{ route('customer.products.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Keranjang</h5>
                    <p class="card-text">Kelola keranjang belanja Anda.</p>
                    <a href="{{ route('customer.cart.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pesanan</h5>
                    <p class="card-text">Lihat riwayat pesanan Anda.</p>
                    <a href="{{ route('customer.orders.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>
@endsection