@extends('layouts.app')
@section('title', 'User Dashboard')

@section('content')
<div class="card shadow-sm rounded-4 p-4">
    <h2>Welcome, {{ auth()->user()->name }}</h2>
    <p class="lead">Explore our categories and products.</p>
    <a href="{{ route('categories.index') }}" class="btn btn-primary mt-3"> Start Shopping</a>
</div>
@endsection
