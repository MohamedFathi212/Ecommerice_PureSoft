@extends('layouts.app')
@section('title', 'User Dashboard')

@section('content')
<div class="container py-4">
    <!-- Welcome Card -->
    <div class="card shadow-sm rounded-4 p-4 mb-4">
        <h2 class="mb-2">Welcome, <span class="text-primary">{{ auth()->user()->name }}</span></h2>
        <p class="lead">Explore our categories and manage your orders easily.</p>

        <div class="mt-3 d-flex gap-2">
            <a href="{{ route('categories.index') }}" class="btn btn-primary">
                🛍️ Start Shopping
            </a>
            <a href="{{ route('orders.index') }}" class="btn btn-success">
                📦 My Orders
            </a>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="card shadow-sm rounded-4 p-4">
        <h4 class="mb-3">📌 Recent Orders</h4>

        @if($orders->count())
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ number_format($order->total, 2) }} EGP</td>
                            <td>
                                <span class="badge 
                                    @if($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'shipped') bg-info
                                    @elseif($order->status == 'delivered') bg-success
                                    @else bg-danger @endif">
                                    @if($order->status == 'pending') ⏳
                                    @elseif($order->status == 'shipped') 🚚
                                    @elseif($order->status == 'delivered') ✅
                                    @else ❌
                                    @endif
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" 
                                   class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info mt-3 rounded-3">
                You haven’t placed any orders yet. 🛒  
                <a href="{{ route('categories.index') }}" class="alert-link">Start Shopping</a>
            </div>
        @endif
    </div>
</div>
@endsection
