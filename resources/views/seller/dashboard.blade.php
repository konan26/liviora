<!-- resources/views/seller/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard Seller')

@section('content')
    <h2>Dashboard Seller</h2>
    <p>Selamat datang, {{ Auth::user()->nama_lengkap }}!</p>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Kelola Seller</h5>
                    <p class="card-text">Tambah atau lihat seller lain.</p>
                    <a href="{{ route('seller.users.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produk</h5>
                    <p class="card-text">Kelola produk Anda.</p>
                    <a href="{{ route('seller.products.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pesanan</h5>
                    <p class="card-text">Verifikasi pesanan pelanggan.</p>
                    <a href="{{ route('seller.orders.index') }}" class="btn btn-primary">Lihat</a>
                </div>
            </div>
        </div>
    </div>
@endsection