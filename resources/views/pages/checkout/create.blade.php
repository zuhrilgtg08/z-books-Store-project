@extends('layouts.main')

@section('main-content')
    <main class="mt-5">
        <div class="py-5 text-center">
            <h3>Buat Pesanan</h3>
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

        <div class="row g-5">
            <div class="col-md-7 col-lg-8 order-md-last">
                <h4 class="mb-3 text-center">Input Data Pesanan Anda</h4>
                <form class="d-inline" action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_belanja" value="{{ $totalBelanja }}" id="total_belanja"/>
                    @foreach ($itemData as $item)
                        <input type="hidden" name="keranjang_id" value="{{ $item->id }}" />
                    @endforeach

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nama Pemesan : </label>
                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" disabled readonly />
                        </div>
            
                        <div class="col-sm-6">
                            <label for="phone" class="form-label">Nomor Hp :</label>
                            <input type="text" class="form-control" id="phone" value="{{ Auth::user()->number_phone }}" min="0" disabled readonly />
                        </div>
            
                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled readonly />
                        </div>

                        <div class="col-sm-6">
                            <label for="weight" class="form-label">Total Berat :</label>
                            <input type="hidden" name="weight" id="weight" class="form-control" value="{{ $totalBerat }}" />
                            <input type="text" id="weight" class="form-control text-danger fw-bold" value="{{ $totalBerat / 1000 }} Kg" disabled />
                        </div>

                        <div class="col-md-6">
                            <label for="province" class="form-label">Provinsi Tujuan :</label>
                            <select class="form-select" name="province_id" id="province" required>
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinces as $item)
                                    <option value="{{ $item->id }}">{{ old('province_id', $item['name_province']) }}</option>
                                @endforeach
                            </select>
                        </div>
            
                        <div class="col-md-6">
                            <label for="city" class="form-label">Kota/Kabupaten :</label>
                            <select class="form-select" name="destination_id" id="destination" required>
                                <option>Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
            
                        <div class="col-md-3">
                            <label for="courier" class="form-label">Pilih Kurir :</label>
                            <select class="form-select" name="courier" id="courier" required>
                                <option disabled selected>Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS INDONESIA</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="layanan-ongkir" class="form-label">Layanan :</label>
                            <select class="form-select" name="layanan_ongkir" id="layanan-ongkir" required>
                                <option selected value="">Pilih Paket</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="services" class="form-label">Harga :</label>
                            <select class="form-select" name="harga_ongkir" id="services" required>
                                <option selected value="">Pilih Harga</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat :</label>
                            <textarea class="form-control" placeholder="Tulis Alamat" id="alamat" style="height: 100px" name="alamat" required>{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    <div class="text-end">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-fw fa-check"></i> 
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 col-lg-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-danger">Pesanan Anda</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach ($itemData as $item)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item->buku->judul_buku }}</h6>
                                <small class="text-danger">Kode Buku : {{ $item->buku->kode_buku }}</small>
                            </div>
                            <span class="text-danger">{{$item->quantity }} item </span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total Pesanan (Rp) : </span>
                        <strong>@currency($totalBelanja)</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Ongkos Kirim : </span>
                        <strong class="cost-ongkir">Rp. 0</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Paket : </span>
                        <strong class="paket-ongkir">-</strong>
                    </li>
                </ul>
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <h5 class="d-flex justify-content-between align-items-center">
                            <span>Total Harga (Rp) : </span>
                            <strong class="total-harga text-success">Rp. 0</strong>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
                $('select[name="province_id"]').on('change', function() {
                    let provinces = $(this).val();
                    if(provinces) {
                        $.ajax({
                            type: "GET",
                            url: "/city/" + provinces,
                            dataType: "json",
                            success: function (response) {
                                $('select[name="destination_id"]').empty();
                                $.each(response, function(key, value) {
                                    $('select[name="destination_id"]').append(
                                        '<option value="'+ value.id +'">' + value.nama_kab_kota + '</option>'
                                    );
                                });
                            }
                        });
                    } else {
                        $('select[name="destination_id"]').empty();
                    }
                });

                $('select[name="courier"]').on('change', function() {
                    let destination = $("select[name=destination_id]").val();
                    let courier = $("select[name=courier]").val();
                    let weight = $("input[name=weight]").val();

                    if(courier) {
                        jQuery.ajax ({
                            url:"/destination="+destination+"&weight="+weight+"&courier="+courier,
                            type:'GET',
                            dataType:'json',
                            success:function(response) {
                                $('select[name="harga_ongkir"]').empty();
                                $('select[name="layanan_ongkir"]').empty();
                                $('.total-harga').empty();
                                response = response[0];
                                    $.each(response.costs, function(key, value) {
                                        let cost = value.cost[0];
                                        $('select[name="harga_ongkir"]').append('<option value="'+ cost.value + '">' + ' Rp. ' + cost.value + '</option>');
                                        $('select[name="layanan_ongkir"]').append('<option value="'+ value.service + ' : ' + cost.etd + ' (days) '+'">' + value.service + ' - ' + value.description + ' : ' + cost.etd + ' (days) ' + '</option>');
                                    });
                                const total_belanja = $('#total_belanja').val();
                                let costKurir = response.costs[0].cost[0].value;
                                let paketOngkir = `${response.costs[0].service} : ${response.costs[0].cost[0].etd} (days)`;
                                $('.cost-ongkir').html(`Rp. ${costKurir}`);
                                $('.paket-ongkir').html(paketOngkir);
                                $('.total-harga').html(`Rp. ${parseInt(costKurir) + parseInt(total_belanja)}`);
                            }
                        });
                    }else {
                        $('select[name="harga_ongkir"]').empty();
                        $('select[name="layanan_ongkir"]').empty();
                    }
                });

                $('#services').on('change', function(){
                    let services = $(this).val();
                    const total_belanja = $('#total_belanja').val();
                    $('.cost-ongkir').html(`Rp. ${services}`);
                    $('.total-harga').html(`Rp. ${parseInt(services) + parseInt(total_belanja)}`);
                });

                $('#layanan-ongkir').on('change', function(){
                    let paketOngkir = $(this).val();
                    $('.paket-ongkir').html(paketOngkir);
                });
            });
    </script>
@endsection
