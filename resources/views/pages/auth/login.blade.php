@extends('layouts.main', ["title" => "Login Form"])
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 mt-3">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session()->has('loginFailed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('loginFailed') }}
                </div>
            @endif

            <div class="card border-0 shadow-lg my-5">
                <div class="card-header bg-dark">
                    <h5 class="text-center fw-semibold text-white">Please Login</h5>
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