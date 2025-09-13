@extends('layouts.app')
@section('title', 'Product Details')

@section('content')
<div class="card shadow-sm rounded-4 p-4">
    <h2>{{ $product->name }}</h2>

    @if($product->image)
        <img src="{{ asset('images/products/' . $product->image) }}" class="img-fluid mb-3 rounded" style="max-width: 250px;">
    @endif

    <p><strong>Category:</strong> {{ $product->category->name ?? '-' }}</p>
    <p><strong>SubCategory:</strong> {{ $product->subcategory->name ?? '-' }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
