@extends('layouts.app')
@section('title', 'SubCategories')
@section('content')

<div class="card shadow-sm rounded-4 p-4">
    <h2>SubCategories</h2>
    <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary mb-3">+ Add SubCategory</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subcategories as $subcategory)
                <tr>
                    <td>{{ $subcategory->id }}</td>
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->category->name }}</td>
                    <td>
                        @if($subcategory->image)
                            <img src="{{ asset('images/subcategories/'.$subcategory->image) }}" width="60">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.subcategories.show', $subcategory->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No SubCategories found</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $subcategories->links() }}
</div>
@endsection
