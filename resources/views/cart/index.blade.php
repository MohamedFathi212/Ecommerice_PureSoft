@extends('layouts.app')
@section('title', 'Your Cart')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Your Cart</h2>
    @if($cart && $cart->items->count() > 0)
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price (EGP)</th>
                    <th>Quantity</th>
                    <th>Total (EGP)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->product->price, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                            @csrf
                            @method('PUT')
                            <input type="number" 
                                   name="quantity" 
                                   value="{{ $item->quantity }}" 
                                   min="1" 
                                   class="form-control w-50 me-2">
                            <button type="submit" class="btn btn-sm btn-warning">Update</button>
                        </form>
                    </td>
                    <td>{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-end">
            Grand Total: 
            <span class="text-success">{{ number_format($cart->total(), 2) }} EGP</span>
        </h4>

        <div class="d-flex justify-content-between mt-3">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Clear Cart</button>
            </form>

            <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    @else
        <div class="alert alert-info">Your cart is empty.</div>
    @endif
</div>
@endsection
