@extends('layouts.main', ["title" => "Account Profile"])
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 mt-5">
            @if (session()->has('success'))
                <div class="alert alert-success col-md-8 mt-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
    
            @if (session()->has('errors'))
                <div class="alert alert-danger col-md-8 mt-3" role="alert">
                    {{ session('errors') }}
                </div>
            @endif
    
            <div class="card border-0 shadow-lg my-3">
                <div class="card-header text-center">
                    <h1 class="h2 text-gray-800">Edit Profile Account</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile-user.update', $customer->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $customer->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $customer->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <!--hidden OldImage-->
                            <input type="hidden" name="oldImage" value="{{ $customer->image }}">
                            @if ($customer->image)
                                <img src="{{ asset('storage/' . $customer->image )}}"
                                    class="img-preview img-fluid mb-3 sm-2 d-block">
                            @else
                                <img class="img-preview img-fluid mb-3 sm-2">
                            @endif
                                <input type="file" class="form-control-file" @error('image') is-invalid @enderror id="image"
                                    name="image" onchange="previewProfile()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                name="alamat" value="{{ old('alamat', $customer->alamat) }}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Number Phone</label>
                            <input type="text" class="form-control @error('number_phone') is-invalid @enderror" id="phone"
                                name="number_phone" value="{{ old('number_phone', $customer->number_phone) }}">
                            @error('number_phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-success w-25">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function previewProfile() {
                const image = document.querySelector('#image');
                const imagePreview = document.querySelector('.img-preview');
                imagePreview.style.display = 'block';
    
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
    
                oFReader.onload = function(oFREvent) {
                    imagePreview.src = oFREvent.target.result;
                }
            }
    </script>
@endsection