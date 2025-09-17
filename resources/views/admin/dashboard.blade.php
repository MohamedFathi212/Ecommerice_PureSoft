@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex">
    <div class="bg-dark text-white p-3 shadow vh-100" style="width: 240px; position: fixed; left: 0; top: 0;">
        <h4 class="text-center mb-4">Admin Panel</h4>
        <ul class="nav flex-column gap-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active-link' : 'text-dark' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}"
                    class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active-link' : 'text-white' }}">
                    <i class="bi bi-folder"></i> Categories
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}"
                    class="nav-link {{ request()->routeIs('admin.products.*') ? 'active-link' : 'text-white' }}">
                    <i class="bi bi-bag"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}"
                    class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active-link' : 'text-white' }}">
                    <i class="bi bi-receipt"></i> Orders
                </a>
            </li>
        </ul>
    </div>

    <div class="flex-grow-1 p-4" style="margin-left: 240px;">
        <h2 class="mb-5">Welcome Back, <span class="text-primary">Admin</span></h2>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-4 border-0 bg-primary text-white">
                    <h5 class="fw-bold">Users</h5>
                    <h2>{{ $usersCount }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-4 border-0 bg-info text-white">
                    <h5 class="fw-bold">Categories</h5>
                    <h2>{{ $categoriesCount }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-4 border-0 bg-warning text-dark">
                    <h5 class="fw-bold">Products</h5>
                    <h2>{{ $productsCount }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-4 border-0 bg-danger text-white">
                    <h5 class="fw-bold">Orders</h5>
                    <h2>{{ $ordersCount }}</h2>
                </div>
            </div>
        </div>

        <div class="card shadow-lg mt-4">
            <div class="card-header fw-bold">Recent Orders</div>
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M, Y h:i A') }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                
                                <a href="{{ route('admin.orders.edit', $order->id) }}" 
                                class="btn btn-warning btn-sm">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No recent orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-link {
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        padding-left: 12px;
    }

    .active-link {
        background: #0d6efd;
        border-radius: 6px;
        font-weight: bold;
    }
</style>
@endsection
