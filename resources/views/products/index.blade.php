@extends('layouts.app')
@section('title', 'All Products')
@section('content')
<div class="container">
    <h2 class="mb-4">All Products</h2>

    {{-- Filters --}}
    <form method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">-- All Categories --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <select name="subcategory" class="form-select" onchange="this.form.submit()">
                    <option value="">-- All SubCategories --</option>
                    @foreach($categories as $cat)
                        @foreach($cat->subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ request('subcategory') == $sub->id ? 'selected' : '' }}>
                                {{ $cat->name }} → {{ $sub->name }}
                            </option>
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    {{-- Products --}}
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">

                    {{-- Product Image --}}
                    @php
                        $imagePathStorage = 'storage/products/' . $product->image;
                        $imagePathPublic = 'images/products/' . $product->image;
                    @endphp

                    @if($product->image && file_exists(public_path($imagePathStorage)))
                        <img src="{{ asset($imagePathStorage) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px; object-fit:cover;">
                    @elseif($product->image && file_exists(public_path($imagePathPublic)))
                        <img src="{{ asset($imagePathPublic) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/200x200?text=No+Image" class="card-img-top" alt="No Image">
                    @endif

                    <div class="card-body">
                        <h5>{{ $product->name }}</h5>
                        <p class="text-muted">
                            {{ $product->category->name ?? '' }} - {{ $product->subcategory->name ?? '' }}
                        </p>
                        <p class="fw-bold">{{ number_format($product->price, 2) }} EGP</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
