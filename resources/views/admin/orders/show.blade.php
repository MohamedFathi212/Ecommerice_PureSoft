@extends('layouts.app')
@section('title', 'Order Details')

@section('content')
<div class="card shadow-sm rounded-4 p-4">
    <h2>Order #{{ $order->id }}</h2>

    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Total:</strong> {{ $order->total_price }} EGP</p>
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
        @foreach($order->items as $item)
            <li>
                {{ $item->product->name }} - 
                Quantity: {{ $item->quantity }} - 
                Price: {{ $item->price }} EGP
            </li>
        @endforeach
    </ul>

    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-3">
        @csrf
        <label for="status">Change Status:</label>
        <select name="status" class="form-select w-25 d-inline-block">
            <option value="pending" @selected($order->status == 'pending')>Pending</option>
            <option value="processing" @selected($order->status == 'processing')>Processing</option>
            <option value="completed" @selected($order->status == 'completed')>Completed</option>
            <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Update</button>
    </form>
</div>
@endsection
