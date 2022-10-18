@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.reviews'])
@section('admin-content')
<div class="row mb-3">
    <div class="col-md-4">
        <a href="{{ route('admin-reviews.index') }}" class="btn btn-dark mb-3">
            <i class="fas fa-fw fa-arrow-left"></i>
            Back
        </a>
    </div>
</div>

<h1 class="h2 text-gray-800 text-center">Detail Review</h1>

<div class="row justify-content-center">
    <div class="card border-0 shadow-lg my-3" style="width: 22rem;">
        @if ($data->image)
            <img src="{{ asset('storage/' . $data->image) }}" alt="profile-customers" class="card-img-top">
        @else
            <img src="{{ asset('assets/images/default-user.png') }}" alt="profile-customers" class="card-img-top">
        @endif
        <div class="card-body">
            <h5 class="card-title">Judul : {{ $data->judul_buku }}</h5>
            <h6 class="card-title">Sinopsis : {{ $data->excerpt }}</h6>
            <p class="card-text">Rating : {{ $data->ReviewData[0]->star_rating }} 
                <i class="fas fa-fw fa-star"></i>
            </p>
            <p class="card-text">Comments: {{ $data->ReviewData[0]->comments }}</p>
        </div>
    </div>
</div>
@endsection