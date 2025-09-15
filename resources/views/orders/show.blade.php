@extends('layouts.app')
@section('title', 'Order Details')

@section('content')
<div class="container py-4">
    <h2>Order #{{ $order->id }}</h2>

    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Total:</strong> {{ $order->total_price }} EGP</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>

    <h4 class="mt-4">Items:</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->price }} EGP</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price * $item->quantity }} EGP</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>

        @if($order->status == 'pending')
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this order?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancel Order</button>
            </form>
        @endif
    </div>
</div>
@endsection
