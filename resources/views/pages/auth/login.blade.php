@extends('layouts.main', ["title" => "Login Form"])
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 mt-3">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session()->has('loginFailed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('loginFailed') }}
                </div>
            @endif

            <div class="card border-0 shadow-lg my-5">
                <div class="card-header bg-dark">
                    <h5 class="text-center fw-semibold text-white mt-3 mb-3">Please Login</h5>
                </div>

                <div class="card-body">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Account</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" autofocus
                                required value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Your Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-dark w-50">Login</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <small>Not Registered ? <a href="/register">Register Now</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection