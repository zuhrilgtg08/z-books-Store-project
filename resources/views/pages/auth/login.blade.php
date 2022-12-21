@extends('layouts.main', ["title" => "Login Form"])
@section('main-content')
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }

        .img-sample img{
            animation: bounce 3s linear infinite;;
            transition: all ease-in-out .3s;
        }

        @keyframes bounce {
            0%,
            100% {
                transform: translateY(0rem);
            }
            
            50% {
                transform: translateY(-1rem);
            }
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

    <div class="row justify-content-center my-5">
        <div class="container h-custom mt-4">
            <div class="row d-flex justify-content-center align-items-center h-100 my-5">
                <div class="col-md-9 col-lg-6 col-xl-5 img-sample">
                    <img src="{{ asset('assets/images/books-illustrasi.png') }}"
                        class="img-fluid rounded-0" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
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
    
                        <div class="d-flex">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="1" id="remember" name="remember_me"/>
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>
    
                        <div class="text-center mt-4 pt-2">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark w-50">Login</button>
                            </div>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? 
                                <a href="/register">Register Now</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection