@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <div class="row">

            {{-- Product Image --}}
            <div class="col-md-5 text-center">
                @php
                    $imagePathStorage = 'storage/products/' . $product->image;
                    $imagePathPublic = 'images/products/' . $product->image;
                @endphp

                @if($product->image && file_exists(public_path($imagePathStorage)))
                    <img src="{{ asset($imagePathStorage) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
                @elseif($product->image && file_exists(public_path($imagePathPublic)))
                    <img src="{{ asset($imagePathPublic) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
                @else
                    <img src="https://via.placeholder.com/400x400?text=No+Image" alt="No Image" class="img-fluid rounded shadow">
                @endif
            </div>

            {{-- Product Details --}}
            <div class="col-md-7">
                <h2>{{ $product->name }}</h2>
                <p class="text-muted">
                    Category: {{ $product->category->name ?? 'N/A' }} 
                    @if($product->subcategory) 
                        → {{ $product->subcategory->name }} 
                    @endif
                </p>
                <h4 class="fw-bold text-success">{{ number_format($product->price, 2) }} EGP</h4>
                <p class="mt-3">{{ $product->description }}</p>

                <button class="btn btn-lg btn-primary mt-3"> Add to Cart</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg mt-3"> Back to Products</a>
            </div>
        </div>
    </div>
</div>
@endsection
