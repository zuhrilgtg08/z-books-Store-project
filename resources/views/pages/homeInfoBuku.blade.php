@extends('layouts.main', ["title" => "Book Info"])
@section('main-content')
<style>
    .header {
        padding: 30px;
        font-size: 40px;
        text-align: center;
        background: white;
    }

    .leftcolumn {
        float: left;
        width: 75%;
    }

    /* Right column */
    .rightcolumn {
        float: left;
        width: 25%;
        padding-left: 20px;
    }
    .fakeimg {
        background-color: #aaa;
        width: 100%;
        padding: 20px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
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

    .rate:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .rating-container .form-control:hover,
    .rating-container .form-control:focus {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .rating-container textarea:focus,
    .rating-container input:focus {
        color: #000;
    }
</style>

<div class="row mt-3 justify-content-center">
    <h2 class="text-center font-semibold mt-5">Book Info</h2>
    <div class="col-md-8 mt-3">
        <div class="card border-0 shadow-lg mt-4">
            @if ($info->image)
            <div style="max-height: 350px; overflow: hidden">
                <img src="{{ asset('storage/' . $info->image) }}" alt="book-info" class="card-img-top">
            </div>
            @else 
                <img src="{{ asset('assets/cover-404.jpg') }}" alt="book-info" class="card-img-top">
            @endif
            <div class="card-body">
                <h3 class="card-title font-bold">{{ $info->judul_buku }}</h3>
                <hr>
                <h5 class="card-text text-base fs-5">Author : {{ $info->author->nama_author }}</h5>
                <h5 class="card-text text-base fs-5">Category : {{ $info->category->name }}</h5>
                <h5 class="card-text text-base fs-5 mb-3">Penerbit : {{ $info->penerbit->nama_penerbit }}</h5>
                <h5 class="card-text text-base fs-5">Kode Buku : {{ $info->kode_buku }}</h5>
                <h5 class="card-text text-base fs-5">Tahun : {{ $info->penerbit->tahun_terbit }}</h5>
                <h5 class="card-text text-base fs-5">Stok : {{ $info->stok }} Buku</h5>
                <h5 class="card-text text-base fs-5">Harga : @currency($info->harga)</h5>
                <hr> 
                <h4 class="mb-3 text-base">Sinopsis : </h4>
                <p class="lead">
                    {!! $info->sinopsis !!}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3 justify-content-start">
    <div class="col-md-10 mt-5">
        <!-- form review-->
        <form class="row g-3" method="POST" action="{{ route('review.store') }}">
            @csrf
            <input type="hidden" value="{{ $info->id }}" name="buku_id">
            @if (session()->has('success'))
                <div class="alert alert-success col-md-8" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-4">
                <label for="name" class="form-label">name</label>
                <input type="text" class="form-control" id="name" required name="name">
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">email</label>
                <input type="email" class="form-control" id="email" required name="email">
            </div>
            <div class="col-md-6">
                <label for="number-phone" class="form-label">Number phone</label>
                <input type="text" class="form-control" id="number-phone" required name="number_phone">
            </div>
            <div class="col-sm-6">
                <div class="rate">
                    <input type="radio" id="star5" class="rate" name="rating" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" checked id="star4" class="rate" name="rating" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" class="rate" name="rating" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" class="rate" name="rating" value="2">
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" class="rate" name="rating" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
            </div>
            <div class="form-group row mt-4">
                <div class="col-sm-12 ">
                    <textarea class="form-control" name="comment" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</div>
@endsection