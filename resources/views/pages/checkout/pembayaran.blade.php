@extends('layouts.main')

@section('main-content')
    <main class="mt-5">
        <div class="py-5 text-center">
            <h3>Konfirmasi Pembayaran</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9 mt-4">
                <div class="text-start col-md-6 mb-3">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session('success') }}
                        </div>
                    @endif
                
                    @if (session()->has('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ session('errors') }}
                        </div>
                    @endif
                </div>
                
                <div class="card border-0 shadow-lg">
                    <div class="card-body mt-3">
                        <div class="row justify-content-between">
                            <div class="col-lg-7">
                                <div class="col-xl-10">
                                    <ul class="list-unstyled">
                                        @foreach ($dataPesanan as $order)
                                            @if ($order->transaction_status == null)
                                                <li class="text-muted">Kepada : <span class="fw-bolder">{{ Auth::user()->name }}</span></li>
                                                <li class="text-muted">Provinsi : {{ $order->province->name_province }}</li>
                                                <li class="text-muted">Kota/Kabupaten : {{ $order->cities->nama_kab_kota }}</li>
                                                <li class="text-muted">Alamat : {{ $order->alamat }}</li>
                                                <li class="text-muted text-primary">No Telp : <i class="fas fa-fw fa-phone"></i>
                                                    {{ Auth::user()->number_phone }}
                                                </li>
                                                <li class="text-muted">Email : <i class="fas fa-fw fa-envelope"></i>
                                                    {{ Auth::user()->email }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <h5 class="d-flex align-items-center">
                                        <span>Detail Pesanan : </span>
                                    </h5>
                                    <ul class="list-group mb-3">
                                        @foreach ($dataKeranjang as $cart)
                                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                                <div>
                                                    <h6 class="my-0">{{ $cart->buku->judul_buku }}</h6>
                                                    <small class="text-danger">@currency($cart->buku->harga)</small>
                                                </div>
                                                <span class="text-danger">{{ $cart->quantity }} Item</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <ul class="list-group mb-3">
                                    @foreach ($dataPesanan as $order)
                                        @if ($order->transaction_status == null) 
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Kurir : </span>
                                                <strong>{{ $order->courier }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Paket : </span>
                                                <strong>{{ $order->layanan_ongkir }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Pesanan (Rp) : </span>
                                                <strong>@currency($order->total_belanja)</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Ongkos Kirim : </span>
                                                <strong>@currency($order->harga_ongkir)</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Harga (Rp) : </span>
                                                <strong class="text-success fw-bold">@currency($order->total_belanja + $order->harga_ongkir)</strong>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-success text-capitalize" id="pay-button">
                            <i class="fas fa-fw fa-wallet"></i>
                            Bayar Sekarang
                        </button>
                        <form action="{{ route('checkout.konfirmasi_pembayaran') }}" id="submit_form" method="POST">
                            @csrf
                            <input type="hidden" name="json" id="json_callback">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
                window.snap.pay('<?=$snapToken?>', {
                    onSuccess: function(result){
                    send_response_to_form(result);
                },
                    onPending: function(result){
                    send_response_to_form(result);
                },
                    onError: function(result){
                    send_response_to_form(result);
                },
                    onClose: function(){
                    return;
                    console.error(result);
                }
            });
        });

        function send_response_to_form(result){
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit_form').submit();
        }
    </script>
@endsection