@extends('layouts.app')
@section('title', 'Manage Orders')

@section('content')
<div class="card shadow-sm rounded-4 p-4">
    <h2>All Orders</h2>

    @if($orders->count())
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th width="250">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ number_format($order->total_price, 2) }} EGP</td>
                        <td>
                            <span class="badge 
                                @if($order->status == 'pending') bg-warning
                                @elseif($order->status == 'processing') bg-info
                                @elseif($order->status == 'completed') bg-success
                                @else bg-danger @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="btn btn-info btn-sm">View</a>

                            <form action="{{ route('admin.orders.destroy', $order->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    @else
        <p class="text-muted">No orders found.</p>
    @endif
</div>
@endsection
