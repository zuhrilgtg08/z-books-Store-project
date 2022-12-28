@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'ordersCustomer'])
@section('admin-content')
    <div class="row mb-3">
        <div class="col-md-4">
            <a href="{{ route('admin-orders.index') }}" class="btn btn-dark mb-3">
                <i class="fas fa-fw fa-arrow-left"></i>
                Back
            </a>
        </div>
    </div>    
    <div class="row justify-content-center mb-3">
        <div class="col-md-9">
            <div class="card border-0 shadow-lg">
                <h1 class="h2 text-gray-800 text-center py-4">Detail Order Customer</h1>
                <div class="col-lg-12 shadow-inner mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h4 class="fw-bolder mb-3">Invoice : <span class="text-danger">{{ $noInvoice }}</span></h4>
                            <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                <thead class="text-light" style="background-color: #301934">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($dataOrder as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->buku->judul_buku }}</td>
                                            <td>{{ $data->quantity }} buku</td>
                                            <td>@currency($data->buku->harga)</td>
                                            <td>{{ $data->order->payment_type }}</td>
                                            <td>
                                                @if($data->status == 'pending')
                                                    <span class="badge badge-primary">{{ $data->status }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ $data->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 shadow-inner">
                    <div class="row g-0 justify-content-evenly">
                        <div class="col-md-6">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="text-black">Nama : {{ $nama }}</li>
                                    <li class="text-black">Provinsi : {{ $province }}</li>
                                    <li class="text-black">Kota/Kabupaten : {{ $kota }}</li>
                                    <li class="text-black">Alamat : {{ $alamat }}</li>
                                    <li class="text-black">No Telp : {{ $no_telp }} </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="text-black">Kurir : {{ $kurir }}</li>
                                    <li class="text-black">Paket : {{ $paket }}</li>
                                    <li class="text-black">Harga Ongkir : @currency($ongkir)</li>
                                    <li class="text-black">Total Harga Pembelian : @currency($beli)</li>
                                    <li class="text-black mt-2">
                                        <h3 class="text-primary fw-bold">Total : @currency($total)</h3>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection