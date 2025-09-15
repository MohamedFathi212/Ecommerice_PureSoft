@extends('layouts.app')
@section('title', 'Register')
@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg rounded-4 p-4" style="min-width: 450px;">
        <div class="card-body">
            <h3 class="text-center mb-4"> Create a New Account </h3>
            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input value="{{ old('name') }}" type="text" name="name" class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror" placeholder="Enter your name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input value="{{ old('email') }}" type="email" name="email" class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror" placeholder="Enter your email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror" placeholder="Enter your password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg rounded-3" placeholder="Re-enter your password" required>
                </div>
                <div class="d-grid">
                    <button class="btn btn-success btn-lg rounded-3 shadow-sm" type="submit">
                        Register
                    </button>
                </div>
            </form>
            <hr class="my-4">
            <p class="text-center mb-0">
                Already have an account?
                <a class="fw-bold text-decoration-none" href="{{ route('login') }}">
                    Log in
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
