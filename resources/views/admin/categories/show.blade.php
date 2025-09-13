@extends('layouts.app')
@section('title', 'Category Details')
@section('content')
<div class="card shadow-sm p-4 rounded-4">
    <h2>Category Details</h2>

    <p><strong>Name:</strong> {{ $category->name }}</p>

    <div class="mb-3">
        <strong>Image:</strong><br>
        @if($category->image)
            <img src="{{ asset('images/categories/'.$category->image) }}" width="200" class="rounded shadow-sm">
        @else
            <p class="text-muted">No image available</p>
        @endif
    </div>

    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
