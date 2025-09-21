<!-- resources/views/customer/orders/index.blade.php -->
@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <h2>Riwayat Pesanan</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->status_order }}</td>
                    <td>{{ $order->tanggal_order }}</td>
                    <td>
                        <ul>
                            @foreach ($order->items as $item)
                                <li>{{ $item->product->nama_produk }} ({{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection