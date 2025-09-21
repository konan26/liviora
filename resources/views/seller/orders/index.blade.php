<!-- resources/views/seller/orders/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
    <h2>Kelola Pesanan</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->user->nama_lengkap }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->status_order }}</td>
                    <td>{{ $order->tanggal_order }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#verifyOrderModal{{ $order->order_id }}">Verifikasi</a>
                    </td>
                </tr>
                <!-- Verify Modal -->
                <div class="modal fade" id="verifyOrderModal{{ $order->order_id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('seller.orders.verify', $order->order_id) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Verifikasi Pesanan #{{ $order->order_id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="status_order" class="form-label">Status Pesanan</label>
                                        <select name="status_order" class="form-control" required>
                                            <option value="pending" {{ $order->status_order == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status_order == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="shipped" {{ $order->status_order == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="done" {{ $order->status_order == 'done' ? 'selected' : '' }}>Done</option>
                                            <option value="cancelled" {{ $order->status_order == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <h6>Detail Pesanan:</h6>
                                    <ul>
                                        @foreach ($order->items as $item)
                                            <li>{{ $item->product->nama_produk }} ({{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
@endsection