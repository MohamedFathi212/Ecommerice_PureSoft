@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="d-flex">
    <div class="bg-dark text-white p-3 shadow vh-100" style="width: 240px; position: fixed; left: 0; top: 0;">
        <h4 class="text-center mb-4">Admin Panel</h4>
        <ul class="nav flex-column gap-3">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white fw-bold"><i class="bi bi-speedometer2"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="nav-link text-white"><i class="bi bi-folder"></i> Categories</a>
            </li>
            <li>
                <a href="{{ route('admin.subcategories.index') }}" class="nav-link text-white"><i class="bi bi-diagram-3"></i> SubCategories</a>
            <li>
                <a href="{{ route('admin.products.index') }}" class="nav-link text-white"><i class="bi bi-bag"></i> Products</a>
            </li>
        </ul>
    </div>

    <div class="flex-grow-1 p-4" style="margin-left: 240px;">
        <h2 class="mb-5"> Welcome Back, <span class="text-primary">Admin</span></h2>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-5 border-0 bg-gradient-primary text-blue">
                    <!-- <i class="bi bi-people fs-1 mb-3"></i> -->
                    <h5 class="fw-bold">Users</h5>
                    <h2>{{ $usersCount }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-5 border-0 bg-gradient-info text-blue">
                    <!-- <i class="bi bi-folder fs-1 mb-3"></i> -->
                    <h5 class="fw-bold">Categories</h5>
                    <h2>{{ $categoriesCount }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-5 border-0 bg-gradient-success text-blue">
                    <!-- <i class="bi bi-diagram-3 fs-1 mb-3"></i> -->
                    <h5 class="fw-bold">SubCategories</h5>
                    <h2>{{ $subcategoriesCount }}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg rounded-4 text-center p-5 border-0 bg-gradient-warning text-blue">
                    <!-- <i class="bi bi-bag-check fs-1 mb-3"></i> -->
                    <h5 class="fw-bold">Products</h5>
                    <h2>{{ $productsCount }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection