@extends('layouts.app')
@section('title', 'Categories')
@section('content')
<div class="container">
    <h2 class="mb-4">All Categories</h2>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm text-center">
                    @if($category->image)
                        <img src="{{ asset('images/categories/' . $category->image) }}" 
                             class="card-img-top" 
                             alt="{{ $category->name }}" 
                             style="height:200px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/200x200?text=No+Image" 
                             class="card-img-top" 
                             alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary w-100">
                            View Products
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
