@extends('layouts.main', ["title" => "Book Info"])
@section('main-content')
<div class="row mt-5 justify-content-center">
    <h2 class="mt-5">{{ $info->judul_buku }}</h2>
    <h2 class="mt-5">{{ $info->author->nama_author }}</h2>
    <h2 class="mt-5">{{ $info->category->name }}</h2>
    <h2 class="mt-5">{{ $info->penerbit->nama_penerbit }}</h2>

    {!! $info->sinopsis !!}
</div>
@endsection