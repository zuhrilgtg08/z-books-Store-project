@extends('layouts.main')
@section('main-content')
<main class="mt-5">
    <div class="py-5 text-center">
        <h3>History Pembayaran / Pesanan</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-md-6 alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('errors'))
        <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert" id="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('errors') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="container">
                {{-- <div class="row d-flex align-items-baseline">
                    <div class="col-xl-10">
                        <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID : -</strong></p>
                    </div>
                    <div class="col-xl-2 float-end">
                        <a class="btn btn-primary">
                            <i class="fas fa-fw fa-print"></i> Print
                        </a>
                    </div>
                    <hr>
                </div> --}}
    
                <div class="container">
                    <div class="col-md-6 d-flex mb-4">
                        <div class="d-flex align-items-end ">
                            <img src="{{ asset('assets/images/icon-books.png') }}" alt="icon-books" class="img-fluid" />
                            <h4 class="fw-normal text-success" style="margin-left: .5rem;">Z-book's</h4>
                        </div>
                    </div>
    
                    <div class="row">
                        {{-- <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">Kepada : <span class="fw-bolder">{{ Auth::user()->name }}</span></li>
                                <li class="text-muted">Provinsi : -</li>
                                <li class="text-muted">Kota/Kabupaten : Malang</li>
                                <li class="text-muted">Alamat : Jl Singosari No 12 Blok D</li>
                                <li class="text-muted">No Telp : <i class="fas fa-phone"></i> 123-456-789</li>
                            </ul>
                        </div> --}}
                        {{-- <div class="col-xl-4">
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">ID : </span>-</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">
                                        Tanggal : </span>-</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="me-1 fw-bold">Status : </span>   
                                        <span class="badge bg-success fw-bold">-</span></li>
                            </ul>
                        </div> --}}
                    </div>
    
                    <div class="row my-2 mx-1 text-center">
                        <table class="table table-striped table-bordered">
                            <thead class="text-white bg-secondary">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Buku</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($resultOrder as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->buku->judul_buku }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>@currency($item->buku->harga)</td>
                                        <td>@currency($item->buku->harga * $item->quantity)</td>
                                        <td>
                                            <a href="" class="btn btn-primary"><i class="fas fa-fw fa-info"></i></a>
                                            <form action="" method="POST" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" type="submit" onclick="return confirm('Apakah yakin ingin menghapus pesanan ini ?')">
                                                    <i class="fas fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3">catatan dan informasi pembayaran</p>
                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>Rp. 10.000</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Ongkos kirim</span>Rp. 5.000</li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Total Biaya</span>
                                <span style="font-size: 25px;">Rp. 15.000</span>
                            </p>
                        </div>
                    </div> --}}
                    <hr>
                    <div class="row">
                        {{-- <div class="col-xl-9">
                            <p>Terima kasih atas pembelian Anda</p>
                        </div> --}}
                        <div class="col-xl-3">
                            <button type="button" class="btn btn-success text-capitalize" id="pay-button">
                                <i class="fas fa-fw fa-print"></i>
                                Print Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection