@extends('layouts.app')
@section('title', 'Add SubCategory')
@section('content')

<div class="card shadow-sm rounded-4 p-4">
    <h2>Add SubCategory</h2>
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        @error('name')
        <div class="text-danger small">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label class="form-label">SubCategory Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        @error('image')
        <div class="text-danger small">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection