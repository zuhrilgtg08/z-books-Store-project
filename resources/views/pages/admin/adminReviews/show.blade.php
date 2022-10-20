@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.reviews'])
@section('admin-content')
<style>
    .scroll {
    max-height: 15rem;
    overflow-y: auto
    }
</style>

<div class="row">
    <div class="col-md-4">
        <a href="{{ route('admin-reviews.index') }}" class="btn btn-dark">
            <i class="fas fa-fw fa-arrow-left"></i>
            Back
        </a>
    </div>
</div>

<h1 class="h2 text-gray-800 text-center mt-3">Detail Review</h1>

<div class="row justify-content-center">
    <div class="card mt-3 rounded" style="max-width: 900px;">
        @foreach ($buku as $item)
        <div class="row g-0">
            <div class="col-md-4">
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" 
                        alt="cover" class="img-fluid rounded-start">
                @else
                <img src="{{ asset('assets/images/default-user.png') }}" 
                    alt="cover" class="img-fluid rounded-start">
                @endif
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul_buku }}</h5>
                    <p class="card-text lead">{!! $item->sinopsis !!}</p>
                </div>
            </div>
        </div>
        @endforeach
        @foreach ($userRating as $halo)
            <p class="card-text">Rating : {{ $halo->star_rating }}
                <i class="fas fa-fw fa-star text-warning"></i>
            </p>
            <p class="card-text">Comments: {{ $halo->comments }}</p>
            <p class="card-text">User: {{ $halo->user->email }}</p>
        @endforeach
    </div>
</div>
{{-- <div class="card border-0 shadow-lg my-3" style="width: 22rem;">
    @if ($data->image)
        <img src="{{ asset('storage/' . $data->image) }}" alt="profile-customers" class="card-img-top">
    @else
        <img src="{{ asset('assets/images/default-user.png') }}" alt="profile-customers" class="card-img-top">
    @endif
    <div class="card-body">
        <h5 class="card-title">Judul : {{ $data->judul_buku }}</h5>
        <h6 class="card-title">Sinopsis : {!! $data->sinopsis !!}</h6>
        <p class="card-text">Rating : {{ $data->ReviewData[0]->star_rating }} 
            <i class="fas fa-fw fa-star"></i>
        </p>
        <p class="card-text">Comments: {{ $data->ReviewData[0]->comments }}</p>
    </div>
</div> --}}
{{-- <div class="col-md-4"></div> --}}
@endsection