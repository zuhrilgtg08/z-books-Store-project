@extends('layouts.main')
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

<div class="row justify-content-center py-5">
    <div class="row mt-3">
        <h2 class="text-center font-semibold">Detail Buku</h2>
        <div class="col-lg-2 mt-4">
            <a class="btn btn-dark" href="{{ url('/home') }}">
                <i class="fas fa-fw fa-arrow-left"></i>
                Kembali
            </a>
        </div>
        <div class="col-lg-6 mt-4">
            <a href="{{ route('home.rating', auth()->user()->id) }}" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#rating">
                <i class="fas fa-fw fa-thumbs-up"></i>
                Tambah Rating
            </a>
        </div>
        <div class="col-md-6 mt-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('success') }}
                </div>
            @endif
        </div>
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
                        <p class="card-text font-semibold">Penulis: {{ $info->author->nama_author }}</p>
                        <p class="card-text font-semibold">Kategori: {{ $info->category->name }}</p>
                        <p class="card-text font-semibold">Penerbit: {{ $info->penerbit->nama_penerbit }}</p>
                        <p class="card-text font-semibold">Kode Buku: {{ $info->kode_buku }}</p>
                        <p class="card-text font-semibold">Terbit Tahun: {{ $info->penerbit->tahun_terbit }}</p>
                        <p class="card-text font-semibold">Stok: {{ $info->stok }} Buku</p>
                        <p class="card-text font-semibold">Berat: {{ $info->weight / 1000}} Kg</p>
                        <p class="card-text font-semibold">Harga: @currency($info->harga)</p>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{ route('cart.store') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $info->id }}" />
                                    <input type="number" name="quantity" min="0" max="{{ $info->stok }}" 
                                        class="form-control text-center" value="{{ ($info->stok > 0) ? 1 : 0 }}" />
                            </div>
                            <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-fw fa-shopping-cart"></i>
                                        Tambah
                                    </button>
                                </form>
                            </div>
                        </div>
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

<!-- Modal Rating-Comments -->
<div class="modal fade" id="rating" tabindex="-1" aria-labelledby="rating" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rating buku ini </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form method="POST" action="{{ route('review') }}">
                    @csrf
                    <input type="hidden" value="{{ $info->id }}" name="id_buku">
                    <input type="hidden" value="{{ auth()->user()->id }}" name="id_user">

                    @if (!$reviews->isEmpty())
                        @foreach ($reviews as $item)
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                        <div class="rate">
                                            <input type="radio" id="star5" class="rate" name="rating" value="5"
                                                {{ $item->star_rating == 5 ? 'checked' : null }} />
                                            <label for="star5">5 stars</label>
                                            <input type="radio" id="star4" class="rate" name="rating" value="4"
                                                {{ $item->star_rating == 4 ? 'checked' : null }} />
                                            <label for="star4">4 stars</label>
                                            <input type="radio" id="star3" class="rate" name="rating" value="3"
                                                {{ $item->star_rating == 3 ? 'checked' : null }} />
                                            <label for="star3">3 stars</label>
                                            <input type="radio" id="star2" class="rate" name="rating" value="2"
                                                {{ $item->star_rating == 2 ? 'checked' : null }} />
                                            <label for="star2">2 stars</label>
                                            <input type="radio" id="star1" class="rate" name="rating" value="1"
                                                {{ $item->star_rating == 1 ? 'checked' : null }} />
                                            <label for="star1">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="comment" rows="6" placeholder="Comment" maxlength="200" required>{{ old('comment', $item->comments) }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    @else 
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="rate">
                                    <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                    <label for="star5">5 stars</label>
                                    <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                    <label for="star4">4 stars</label>
                                    <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                    <label for="star3">3 stars</label>
                                    <input type="radio" id="star2" class="rate" name="rating" value="2" />
                                    <label for="star2">2 stars</label>
                                    <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                    <label for="star1">1 star</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" rows="6" maxlength="200" required placeholder="Comment">{{ old('comment') }}</textarea>
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