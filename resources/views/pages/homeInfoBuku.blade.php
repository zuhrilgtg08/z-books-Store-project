@extends('layouts.main', ["title" => "Book Info"])
@section('main-content')
<style>
    .scroll {
        max-height: 20rem;
        overflow-y: auto
    }
    
    .fakeimg {
        background-color: #aaa;
        width: 100%;
        padding: 20px;
    }

    .avatar {
        vertical-align: middle;
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        display: none;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label { 
        color: #c59b08;
    }
</style>



<div class="row mt-3">
    <h2 class="text-center font-semibold mt-5">Book Information</h2>
    <div class="col-lg-2 mt-4">
        <a class="btn btn-dark" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-arrow-left"></i>
            Back to Home
        </a>
    </div>
    <div class="col-md-10 mt-3 text-center">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>


<div class="row mt-3">
    <div class="col-md-7 mb-3">
        <div class="card border-0 shadow-lg mt-4 mb-3" style="max-width: 600px;">
            <div class="row g-0">
                <div class="col-md-5 text-center shadow-inner m-auto">
                    @if ($info->image)
                        <img src="{{ asset('storage/' . $info->image) }}" alt="book-info" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;"/>
                    @else
                        <img src="{{ asset('assets/cover-404.jpg') }}" alt="book-info" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;" />
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bolder text-center text-danger">{{ $info->judul_buku }}</h4>
                        <p class="card-text font-semibold">Author: {{ $info->author->nama_author }}</p>
                        <p class="card-text font-semibold">Category: {{ $info->category->name }}</p>
                        <p class="card-text font-semibold">Penerbit: {{ $info->penerbit->nama_penerbit }}</p>
                        <p class="card-text font-semibold">Kode Buku: {{ $info->kode_buku }}</p>
                        <p class="card-text font-semibold">Tahun: {{ $info->penerbit->tahun_terbit }}</p>
                        <p class="card-text font-semibold">Stok: {{ $info->stok }} Buku</p>
                        <p class="card-text font-semibold">Harga: @currency($info->harga)</p>
                        <a href="{{ route('home.rating', auth()->user()->id) }}" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#rating">
                            <i class="fas fa-fw fa-thumbs-up"></i>
                            Beri Rating
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5 mb-3">
        <div class="card border-0 shadow-lg mt-4 mb-3" style="max-width: 600px;">
            <div class="card-title bg-dark text-center">
                <h5 class="text-light font-semibold my-3">Sinopsis : </h5>
            </div>
            <div class="card-body scroll">
                <p class="lead">
                    {!! $info->sinopsis !!}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3 justify-content-center">
    <div class="col-lg-4 mt-3">
        <div class="my-4 text-center">
            <h3 style="color:#0071a1;" class="font-semibold">{{ $info->judul_buku }}</h3>
            <p style="color:#e91e63;" class="font-semibold">Published at : {{$info->created_at->format('jS \\of F Y') }}</p>
            <h4 class="font-semibold text-dark">Comment Section :</h4>
        </div>
    </div>

    <div class="col-lg-8 my-4">
        <div class="card border-0 shadow-lg swiper mySwiper">
            <div class="swiper-wrapper rounded">
                @foreach($reviews as $review)
                    <div class="card-body swiper-slide">
                            <img src="{{ asset('assets/images/default-user.png') }}" class="avatar">

                            <span class="font-weight-bold ml-2">{{$review->name}}</span>
                            <p class="mt-1">
                                @for($i=1; $i<=$review->star_rating; $i++)
                                    <span><i class="fa fa-star text-warning"></i></span>
                                @endfor
                            </p>
                            <p>{{$review->email}}</p>
                            <p class="description ">
                                {{$review->comments}}
                            </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal Rating-Comments -->
<div class="modal fade" id="rating" tabindex="-1" aria-labelledby="rating" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rating This Book </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form method="POST" action="{{ route('review') }}">
                    @csrf
                    <input type="hidden" value="{{ $info->id }}" name="id_buku">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">

                    @if ($reviews->isEmpty())
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required name="name" 
                                value="{{ old('name', auth()->user()->name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" required name="email"
                                value="{{ old('email', auth()->user()->email) }}">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="rate">
                                    <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="rating" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" rows="6" placeholder="Comment" maxlength="200"
                                required>{{ old('comment') }}</textarea>
                        </div>
                    @else 
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required name="name"
                                value="{{ old('name', auth()->user()->name) }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" required name="email"
                                value="{{ old('email', auth()->user()->email) }}" disabled>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                @foreach ($reviews as $bintang)
                                    <div class="rate">
                                        <input type="radio" id="star5" class="rate" name="rating" value="5" {{ $bintang->star_rating == 5 ? 'checked' : null }}/>
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" class="rate" name="rating" value="4" {{ $bintang->star_rating == 4 ? 'checked' : null }}/>
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" class="rate" name="rating" value="3" {{ $bintang->star_rating == 3 ? 'checked' : null }}/>
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" class="rate" name="rating" value="2" {{ $bintang->star_rating == 2 ? 'checked' : null }}/>
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" class="rate" name="rating" value="1" {{ $bintang->star_rating == 1 ? 'checked' : null }}/>
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" rows="6" maxlength="200" required>@foreach ($reviews as $item){{ $item->comments }}@endforeach</textarea>
                        </div>
                    @endif
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection