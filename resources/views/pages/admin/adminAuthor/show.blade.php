@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.author'])
@section('admin-content')
    <div class="row mb-3">
        <div class="col-md-4">
            <a href="{{ route('author.index') }}" class="btn btn-dark mb-3">
                <i class="fas fa-fw fa-arrow-left"></i> 
                Back
            </a>
        </div>
    </div>

    <h1 class="h2 text-gray-800 text-center">Detail Author</h1>

    <div class="row justify-content-between my-5">
        <div class="col-md-4">
            @if ($author->image)
                <img src="{{ asset('storage/' . $author->image) }}" alt="profile-author" 
                    class="img-fluid shadow-lg rounded" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <img src="{{ asset('assets/images/default-user.png') }}" alt="profile-author" 
                    class="img-fluid shadow-lg rounded" style="width: 100%; height: 100%; object-fit: cover;">
            @endif
        </div>
        <div class="col-md-8">
            <h3 class="text-gray-900">{{ $author->nama_author }}</h3>
            <article class="my-3 fs-5 text-gray-900">
                {!! $author->biografi_author !!}
            </article>
        </div>
    </div>
@endsection