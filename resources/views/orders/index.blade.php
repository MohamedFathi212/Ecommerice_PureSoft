@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="container py-4">
    <h2>My Orders</h2>

    @if($orders->count())
        <table class="table table-bordered align-middle mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->total_price }} EGP</td>
                        <td>
                            <span class="badge 
                                @if($order->status == 'pending') bg-warning
                                @elseif($order->status == 'shipped') bg-info
                                @elseif($order->status == 'delivered') bg-success
                                @else bg-danger @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-secondary">View</a>

                            @if($order->status == 'pending')
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted mt-3">You haven’t placed any orders yet.</p>
    @endif
</div>
@endsection
