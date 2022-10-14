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

    <h1 class="h2 text-gray-800 text-center mb-3">Detail Author</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-10 text-center">
            <div class="card border-0 shadow-lg my-5">
                @if ($author->image)
                    <div style="max-height:350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $author->image) }}" alt="profile-author" class="card-img-top">
                    </div>
                @else
                    <img src="{{ asset('assets/images/default-user.png') }}" alt="profile-author" class="card-img-top">
                @endif
                <div class="card-body">
                    <div class="card-title">
                        <h1 class="text-center h3 font-weight-bolder">{{ $author->nama_author }}</h1>
                    </div>
                    <article class="my-3 fs-5">
                        {!! $author->biografi_author !!}
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection