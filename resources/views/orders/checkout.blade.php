@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <h2>Checkout</h2>
    <ul class="list-group mb-3">
        @foreach($cartItems as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $item->product->name }} (x{{ $item->quantity }})
            <span>${{ $item->product->price * $item->quantity }}</span>
        </li>
        @endforeach
    </ul>
    <h4>Total: ${{ $total }}</h4>

    <form action="{{ route('orders.place') }}" method="POST">
        @csrf
        <button class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection