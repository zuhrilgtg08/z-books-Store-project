@extends('layouts.main', ['title' => 'Book Categories'])
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <h2 class="text-center font-semibold mt-5">Books Categories</h2>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3">
            <form action="/home-categories" method="GET">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
            </form>
    
            @foreach ($categories as $category)
                <div class="col-md-4 mt-5">
                    <a href="/home?category={{ $category->slug }}">
                        <div class="card text-white kartu-categories rounded shadow-sm">
                            <img src="{{ asset('assets/images/cover-categories.jpg') }}" 
                                class="card-img" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit:cover;">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgb(36, 121, 231);">
                                    {{ $category->name }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection