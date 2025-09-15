@extends('layouts.app')
@section('title', 'Log in')
@section('content')

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg rounded-4 p-4" style="min-width: 400px;">
        <div class="card-body">
            <h3 class="text-center mb-4"> Sign in </h3>
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input value="{{ old('email') }}" type="email" name="email" class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror" placeholder="Enter your email" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg rounded-3" placeholder="Enter your password" required>
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary btn-lg rounded-3 shadow-sm" type="submit">
                        Login
                    </button>
                </div>
            </form>

            <hr class="my-4">
            <p class="text-center mb-0">
                Don’t have an account?
                <a class="fw-bold text-decoration-none" href="{{ route('register') }}">
                    Sign Up
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
