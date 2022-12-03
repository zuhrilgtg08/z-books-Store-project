@extends('layouts.main')
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 mt-5">
            @if (session()->has('success'))
                <div class="alert alert-success col-md-8 mt-3 alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if (session()->has('errors'))
                <div class="alert alert-danger col-md-8 mt-3 alert-dismissible fade show" role="alert">
                    {{ session('errors') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card border-0 shadow-lg my-3">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">Changes Password</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('password-user.change', $customer_pass->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="old_pass" class="form-label">Old Password</label>
                            <input type="password" class="form-control @error('old_pass') is-invalid @enderror" id="old_pass"
                                name="old_pass">
                            @error('old_pass')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_pass" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('new_pass') is-invalid @enderror" id="new_pass"
                                name="new_pass">
                            @error('new_pass')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_pass" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('confirm_pass') is-invalid @enderror"
                                id="confirm_pass" name="confirm_pass">
                            @error('confirm_pass')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-success">Changes Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection