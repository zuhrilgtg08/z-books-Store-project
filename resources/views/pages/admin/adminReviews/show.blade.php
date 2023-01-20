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
    <div class="card mt-3 rounded" style="max-width: 52rem;">
        @foreach ($buku as $item)
        <div class="row g-0">
            <div class="col-md-4">
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" 
                        alt="cover" class="img-fluid rounded-start">
                @else
                    <img src="{{ asset('assets/images/cover-404.jpg') }}" 
                        alt="covers" class="img-fluid rounded-start">
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

        <div class="row mt-3 my-3">
            <div class="col-md pl-4">
                <h3 class="text-start fw-normal text-danger">Comments Section : </h3>
                @php $no = 1; @endphp
                @if (!$userRating->isEmpty())
                    @foreach ($userRating as $halo)
                        <div class="border border-2 border-dark mb-2"></div>
                        <p class="card-text text-gray-800">User : {{ $halo->user->email }} ({{ $no++ }})</p>
                        <p class="card-text text-gray-800">Rating : {{ $halo->star_rating }}
                            <i class="fas fa-fw fa-star text-warning"></i>
                        </p>
                        <p class="card-text text-gray-800">Comments : {{ $halo->comments }}</p>
                    @endforeach
                @else 
                    <p class="card-text">Review Not Found!</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection