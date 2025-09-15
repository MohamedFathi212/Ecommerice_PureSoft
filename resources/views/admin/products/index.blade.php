@extends('layouts.app')
@section('title', 'Manage Products')
@section('content')

<div class="card shadow-sm rounded-4 p-4">
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">+ Add Product</a>

    @if($products->count())
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>SubCategory</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th width="200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" width="60" class="rounded">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name  }}</td>
                        <td>{{ $product->subcategory->name  }}</td>
                        <td>{{ $product->price }} EGP</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    @else
        <p class="text-muted">No products found.</p>
    @endif
</div>
@endsection
