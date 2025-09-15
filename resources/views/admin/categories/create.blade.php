@extends('layouts.app')
@section('title', 'Add Category')
@section('content')

<div class="card shadow-sm p-4 rounded-4">
    <h2>Add New Category</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
