@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $category->name }}</h2>

    <div class="row">
        @foreach($category->subcategories as $sub)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm text-center">
                    @if($sub->image)
                        <img src="{{ asset('images/subcategories/' . $sub->image) }}" 
                             class="card-img-top" 
                             alt="{{ $sub->name }}" 
                             style="height:200px; object-fit:cover;">
                    @else
                        <img src="https://via.placeholder.com/200x200?text=No+Image" 
                             class="card-img-top" 
                             alt="No Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $sub->name }}</h5>
                        <a href="{{ route('products.index', ['subcategory' => $sub->id]) }}" 
                           class="btn btn-outline-primary w-100">
                            View Products
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
