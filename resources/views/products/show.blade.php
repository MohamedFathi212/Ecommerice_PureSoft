@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm p-4 rounded-4">
        <div class="row g-4 align-items-center">

            {{-- Product Image --}}
            <div class="col-md-5 text-center">
                @php
                    $imagePathStorage = 'storage/products/' . $product->image;
                    $imagePathPublic = 'images/products/' . $product->image;
                @endphp

                <img src="{{ $product->image && file_exists(public_path($imagePathStorage)) 
                        ? asset($imagePathStorage) 
                        : ($product->image && file_exists(public_path($imagePathPublic)) 
                            ? asset($imagePathPublic) 
                            : 'https://via.placeholder.com/400x400?text=No+Image') 
                    }}" 
                    alt="{{ $product->name }}" 
                    class="img-fluid rounded shadow">
            </div>

            {{-- Product Details --}}
            <div class="col-md-7">
                <h2 class="fw-bold">{{ $product->name }}</h2>
                <p class="text-muted mb-2">
                    Category: 
                    <span class="fw-semibold">{{ $product->category->name ?? 'N/A' }}</span>
                    @if($product->subcategory) 
                        → <span class="fw-semibold">{{ $product->subcategory->name }}</span>
                    @endif
                </p>

                <h4 class="fw-bold text-success mb-3">{{ number_format($product->price, 2) }} EGP</h4>
                <p class="mb-4">{{ $product->description }}</p>

                {{-- Add to Cart Form --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-primary">
                        🛒 Add to Cart
                    </button>
                </form>

                <a href="{{ route('products.index') }}" class="btn btn-lg btn-outline-secondary ms-2">
                    ← Back to Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
