@extends('layouts.app')
@section('title', 'SubCategory Details')

@section('content')
<div class="card shadow-sm rounded-4 p-4">
    <h2>SubCategory Details</h2>
    <p><strong>Name:</strong> {{ $subcategory->name }}</p>
    <p><strong>Category:</strong> {{ $subcategory->category->name }}</p>
    @if($subcategory->image)
        <p><strong>Image:</strong></p>
        <img src="{{ asset('images/subcategories/'.$subcategory->image) }}" width="120">
    @endif
    <a href="{{ route('admin.subcategories.index') }}" class="btn btn-primary mt-3">Back</a>
</div>
@endsection
