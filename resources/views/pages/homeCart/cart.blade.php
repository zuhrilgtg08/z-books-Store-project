@extends('layouts.main')
@section('main-content')
<div class="row justify-content-center my-5">
    <h2 class="text-center font-semibold mt-5">Your Carts</h2>

    <div class="col-md-8 mt-5">
        {{-- @foreach ($addPesanan as $item) --}}
            {{-- {{ $addPesanan->judul_buku }} --}}
            {{-- {{ $item->excerpt }}
            <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded-start ml-4" alt="cover-book"
                style="width: 100%; height: 100%; object-fit: cover;" />
                @currency($item->harga) --}}
        {{-- @endforeach --}}
</div>
@endsection