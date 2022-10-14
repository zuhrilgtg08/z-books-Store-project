@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.buku'])
@section('admin-content')
<div class="row mb-3">
    <div class="col-md-4">
        <a href="{{ route('buku.index') }}" class="btn btn-dark mb-3">
            <i class="fas fa-fw fa-arrow-left"></i> 
            Back
        </a>
    </div>
</div>
<h1 class="h2 text-gray-800 text-center mb-3">Detail Buku</h1>

<div class="row justify-content-center mb-3">
    <div class="col-md-10">
        <div class="card border-0 shadow-lg my-5">
            @if ($datas['buku']->image)
                <div style="max-height:350px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $datas['buku']->image) }}" alt="cover-book"
                        class="card-img-top img-fluid">
                </div>
            @else
                <img src="{{ asset('assets/images/cover-404.jpg') }}" alt="cover-book" class="card-img-top img-fluid">
            @endif
            <div class="card-body">
                <div class="card-title">
                    <h2 class="font-weight-bolder text-capitalize">{{ $datas['buku']->judul_buku }}</h2>
                </div>
                @foreach ($datas['authors'] as $item)
                    @if ($item->id == $datas['buku']->author_id)
                        <h3 class="card-title">Nama Author : {{ $item->nama_author }}</h3>
                    @endif
                @endforeach
                @foreach ($datas['penerbits'] as $item)
                    @if ($item->id == $datas['buku']->penerbit_id)
                        <h4 class="card-title">Penerbit : {{ $item->nama_penerbit }}</h4>
                    @endif
                @endforeach
                @foreach ($datas['categories'] as $item)
                    @if ($item->id == $datas['buku']->category_id)
                        <h5 class="card-title">Category : {{ $item->name }}</h5>
                    @endif
                @endforeach
                <article class="my-3 fs-5">
                    {!! $datas['buku']->sinopsis !!}
                </article>
            </div>
        </div>
    </div>
</div>
@endsection