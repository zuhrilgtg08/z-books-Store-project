@extends('layouts.main', ["title" => "Carts"])
@section('main-content')
    <div class="row justify-content-center my-5">
        <h2 class="text-center font-semibold mt-5">Cart Books</h2>

        @foreach ($cartBuku as $cartBukus)
            @if ($cartBukus->stok > 0)
                <div class="card border-0 shadow-lg mt-4 mb-3" style="max-width 850px;">
                    <div class="row">
                        <div class="col-md-4 p-0">
                            <img src="{{ asset('storage/' . $cartBukus->image) }}" class="img-fluid rounded-start ml-4" alt="cover-book"
                                style="width: 100%; height: 100%; object-fit: cover;"/>
                        </div>
                        <div class="col-md-8 my-auto p-0">
                            <div class="card-body">
                                <h3 class="card-title">{{ $cartBukus->judul_buku }}</h3>

                                <form action="/pesan/{{ $cartBukus->id }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $cartBukus->id }}">
                                    <table class="table">
                                        <tr>
                                            <input type="hidden" name="harga" value="{{ $cartBukus->harga }}">
                                            <th scope="row">Harga</th>
                                            <td>:</td>
                                            <td>@currency($cartBukus->harga)</td>
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="stok" value="{{ $cartBukus->stok }}">
                                            <th scope="row">Stok</th>
                                            <td>:</td>
                                            <td>{{ $cartBukus->stok }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sinopsis</th>
                                            <td>:</td>
                                            <td>{{ $cartBukus->excerpt }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><label for="jumlah">Jumlah Order</label></th>
                                            <td>:</td>
                                            <td><input type="number" name="jumlah" id="jumlah" min="1" 
                                                max="{{ $cartBukus->stok }}" required">
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="d-flex justify-content-center text-center mt-4">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-shopping-bag"></i> 
                                            Masukkan Ke Keranjang
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    
    {{-- <div class="card">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $barang->image) }}" class="img-fluid" alt="">
            </div>
            <div class="col-md-8 my-auto">
                <div class="card-body">
                    <h3 class="card-title logo-color">{{ $barang->item_name }}</h3>
                    <form action="/pesan/{{ $barang->id }}" method="post">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                        <table class="table">
                            <tr>
                                <input type="hidden" name="price" value="{{ $barang->price }}">
                                <th scope="row">Harga</th>
                                <td>:</td>
                                <td>Rp {{ number_format($barang->price, 0 , ',', '.') }}</td>
                            </tr>
                            <tr>
                                <input type="hidden" name="stock" value="{{ $barang->stock }}">
                                <th scope="row">Stok</th>
                                <td>:</td>
                                <td>{{ $barang->stock }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Size</th>
                                <td>:</td>
                                <td>{{ $barang->size }}</td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="quantity">Jumlah Pesan</label></th>
                                <td>:</td>
                                <td><input type="number" name="quantity" id="quantity" min="1" max="{{ $barang->stock }}">
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-center text-center">
                            <button type="submit" class="btn btn-secondary"><i class="bi bi-bag-fill"></i> Masukkan Ke
                                Keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection