<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liviora - @yield('title', 'E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Liviora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">Kategori</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports.index') }}">Laporan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports.generate') }}">Generate Laporan</a></li>
                        @elseif (auth()->user()->role === 'staff')
                            <li class="nav-item"><a class="nav-link" href="{{ route('seller.products.index') }}">Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('seller.orders.index') }}">Pesanan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('seller.reports.index') }}">Laporan</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.products.index') }}">Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.cart.index') }}">Keranjang</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.orders.index') }}">Pesanan</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.reports.index') }}">Laporan</a></li>
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>