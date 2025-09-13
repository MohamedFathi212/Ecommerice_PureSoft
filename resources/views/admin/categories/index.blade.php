@extends('layouts.app')
@section('title', 'Manage Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Manage Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add Category</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    @if($category->image)
                        <img src="{{ asset('images/categories/'.$category->image) }}" width="80" alt="">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
