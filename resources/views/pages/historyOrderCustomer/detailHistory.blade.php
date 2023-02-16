@extends('layouts.main')
@section('main-content')
    <main class="py-4">
        <div class="my-5 text-center mb-5">
            <h3>Detail Pembayaran</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-4 mb-3">
                    <a href="{{ route('customer_order_history.index') }}" class="btn btn-dark">
                        <i class="fas fa-fw fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
                <div class="card border-0 shadow-lg">
                    <div class="card-body mx-4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="fw-bolder">Terima kasih atas pembelian Anda</p>
                                </div>
                            </div>
                            <div class="row">
                                <ul class="list-unstyled">
                                    <li class="text-black">Nama : {{ Auth::user()->name }}</li>
                                    <li class="text-danger mt-1"><span class="text-black">Invoice : </span>#{{ $noInvoice }}</li>
                                    <li class="text-black mt-1">Provinsi : {{ $province }}</li>
                                    <li class="text-black mt-1">Kota/Kabupaten : {{ $kota }}</li>
                                    <li class="text-black mt-1">Alamat : {{ $alamat }}</li>
                                    <li class="text-black mt-1">Status Pembayaran : <span class="badge bg-{{ ($status == 'pending') ? 'warning text-black':'success' }}">{{ $status }}</span></li>
                                    <li class="text-success mt-1"><span class="text-black">Email : </span>{{ Auth::user()->email }}</li>
                                    <li class="text-success mt-1"><span class="text-black">No Telp : </span>{{ Auth::user()->number_phone }}</li>
                                </ul>
                                <table class="table table-striped table-bordered text-center">
                                    <thead class="text-white bg-dark">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Buku</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($detailOrder as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->buku->judul_buku }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>@currency($item->buku->harga)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr class="my-4 text-black">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-8 text-end">
                                        <ul class="list-unstyled">
                                            <li class="text-black">Kurir : {{ $kurir }}</li>
                                            <li class="text-black">Paket : {{ $paket }}</li>
                                            <li class="text-black">Harga Ongkir : @currency($ongkir)</li>
                                            <li class="text-black">Total Harga Pembelian : @currency($beli)</li>
                                            <li class="text-black mt-2">
                                                <h3 class="text-success fw-bold">Total : @currency($total)</h3>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection