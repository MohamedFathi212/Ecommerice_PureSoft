@extends('layouts.app')
@section('title', 'Order Details')

@section('content')
<div class="card shadow-sm rounded-4 p-4">
    <h2>Order #{{ $order->id }}</h2>


    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Total:</strong> {{ number_format($order->total_price, 2) }} EGP</p>
    <p><strong>Status:</strong>
        <span class="badge 
            @if($order->status == 'pending') bg-warning
            @elseif($order->status == 'processing') bg-info
            @elseif($order->status == 'completed') bg-success
            @else bg-danger @endif">
            {{ ucfirst($order->status) }}
        </span>
    </p>
    <p><strong>Created at:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

    <h4>Items:</h4>
    <ul>
        @foreach($order->orderItems as $item)
        <li>
            {{ $item->product->name }} -
            Quantity: {{ $item->quantity }} -
            Price: {{ number_format($item->price, 2) }} EGP
        </li>
        @endforeach
    </ul>

    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <label for="status">Change Status:</label>
        <select name="status" class="form-select">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Update</button>
    </form>
</div>
@endsection