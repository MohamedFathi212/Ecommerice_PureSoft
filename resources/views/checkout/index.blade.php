@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>
    <div class="card shadow-sm rounded-4 p-4">
        <h4 class="mb-3">Your Cart</h4>

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price (EGP)</th>
                    <th>Quantity</th>
                    <th>Total (EGP)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-end">Grand Total: <span class="text-success">{{ number_format($cart->total(), 2) }} EGP</span></h4>

        <form action="{{ route('checkout.placeOrder') }}" method="POST" class="text-end mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</div>
@endsection
