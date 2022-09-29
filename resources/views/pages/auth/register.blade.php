@extends('layouts.main', ["title" => "Register Form"])
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 mt-3">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header bg-dark">
                    <h5 class="text-center fw-semibold text-white mt-3 mb-3">Register Now</h5>
                </div>
                <div class="card-body">
                    <form action="/register" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" required value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="emai" name="email"
                                required value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password1" class="form-label">Password</label>
                            <input type="password" class="form-control @error('currentPassword') is-invalid @enderror" id="password1"
                                name="currentPassword" required>
                            @error('currentPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password2" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password2"
                                name="password" required>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark w-50">Register</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <small>All Ready Registered ? <a href="{{ route('login') }}">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection