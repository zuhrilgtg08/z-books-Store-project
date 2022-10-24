@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.buku'])
@section('admin-content')
<style>
    .scroll {
        max-height: 15rem;
        overflow-y: auto
    }
</style>

<div class="row mb-3">
    <div class="col-md-4">
        <a href="{{ route('buku.index') }}" class="btn btn-dark mb-3">
            <i class="fas fa-fw fa-arrow-left"></i> 
            Back
        </a>
    </div>
</div>
<h1 class="h2 text-gray-800 text-center mb-5">Detail Buku</h1>

<div class="row justify-content-between mb-3">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg">
            <div class="row g-0">
                <div class="col-md-5 text-center shadow-inner m-auto">
                    @if ($datas['buku']->image)
                        <img src="{{ asset('storage/' . $datas['buku']->image) }}" alt="cover-book" class="img-fluid rounded"
                            style="width: 100%; height: 100%; object-fit: cover;" />
                    @else
                        <img src="{{ asset('assets/images/cover-404.jpg') }}" alt="cover-book" class="img-fluid rounded"
                            style="width: 100%; height: 100%; object-fit: cover;" />
                    @endif
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h5 class="font-weight-bolder text-capitalize card-title text-center">{{ $datas['buku']->judul_buku }}</h5>
                        @foreach ($datas['authors'] as $item)
                            @if ($item->id == $datas['buku']->author_id)
                                <h6 class="card-text">Nama Author : {{ $item->nama_author }}</h6>
                            @endif
                        @endforeach
                        @foreach ($datas['penerbits'] as $item)
                            @if ($item->id == $datas['buku']->penerbit_id)
                                <h6 class="card-text">Penerbit : {{ $item->nama_penerbit }}</h6>
                            @endif
                        @endforeach
                        @foreach ($datas['categories'] as $item)
                            @if ($item->id == $datas['buku']->category_id)
                                <h6 class="card-text">Category : {{ $item->name }}</h6>
                            @endif
                        @endforeach
                        <h6 class="card-text">Berat : {{ $datas['buku']->weight / 1000 }} Kg</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-lg" style="max-width: 600px;">
            <div class="card-title bg-dark text-center">
                <h5 class="text-light font-semibold my-3">Sinopsis : </h5>
            </div>
            <div class="card-body scroll">
                <p class="lead">
                    {!! $datas['buku']->sinopsis !!}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection