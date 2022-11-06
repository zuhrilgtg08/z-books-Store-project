@extends('layouts.main')
@section('main-content')
    <style>
        .jumbotron-flat {
            background-color: solid #DB8FFF;
            height: 100%;
            border: 1px solid #4DB8FF;
            background: white;
            width: 100%;
            text-align: center;
            overflow: auto;
        }
        
        .paymentAmt img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <div class="row justify-content-center mt-5">
        <div class="col-md-4 mt-5 my-4">
            <h3 class="text-center">Books Checkout</h3>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success col-md-8" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session()->has('errors'))
            <div class="alert alert-danger col-md-8" role="alert">
                {{ session('errors') }}
            </div>
        @endif
    </div>

    <div class="row justify-content-center mt-3">
        <form action="{{ route('tes') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">

            <div class="row g-0 d-flex justify-content-between">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body border-0 shadow-md">
                            <div class="mb-3">
                                <label for="province" class="form-label">Provinsi Tujuan</label>
                                <select class="form-select" name="province_id" id="province" required>
                                    <option value="" selected disabled>Provinsi Tujuan</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id }}">{{ $item['name_province'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="mb-3">
                                <label for="city" class="form-label">Kota Asal</label>
                                <select class="form-select" name="city_id" id="city" required>
                                    <option selected>Kota Asal</option>
                                </select>
                            </div>
                
                            <div class="mb-3">
                                <label for="city" class="form-label">Kota Tujuan</label>
                                <select class="form-select" name="destination_id" id="destination" required>
                                    <option>Kota Tujuan</option>
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label for="courier" class="form-label">Pilih Ekspedisi</label>
                                <select class="form-select" name="courier" id="courier" required>
                                    <option disabled selected>Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS INDONESIA</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body border-0 shadow-md">
                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity Total </label>
                                <input type="hidden" name="quantity" id="qty" class="form-control" value="{{ $qty_Total }}" />
                                <input type="text" id="qty" class="form-control text-danger fw-bold" value="{{ $qty_Total }} Jumlah"
                                    disabled />
                            </div>

                            <div class="mb-3">
                                <label for="total_belanja" class="form-label">Sub Total Harga</label>
                                <input type="hidden" name="total_belanja" value="{{  Cart::priceTotal() }}" class="form-control" />
                                <input type="text" value="Rp. {{Cart::priceTotal()}}" class="form-control text-danger fw-bold" readonly disabled />
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight</label>
                                <input type="hidden" name="weight" id="weight" class="form-control" value="{{ $totalBerat }}" />
                                <input type="text" id="weight" class="form-control text-danger fw-bold" value="{{ $totalBerat / 1000 }} kg" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="services" class="form-label">Pilih Layanan</label>
                                <select class="form-select" name="cost_services" id="services" required>
                                    <option selected value="">Pilih Layanan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="my-3">
                        <h5 class="fw-normal">Biaya Ongkir : <span class="cost-ongkir text-success fw-bold">0</span></h5>
                        <h5 class="fw-normal">Biaya Layanan : <span class="cost-layanan text-success fw-bold">0</span></h5>
                        <h5 class="fw-normal">Total Biaya : <span class="harga text-success fw-bold">0</span></h5>
                    </div>
                    <div class="row justify-content-end mt-3">
                        <div class="col-md-6 text-end">
                            <div class="mb3">
                                <button type="submit" class="btn btn-primary">Pilih Pembayaran</button>
                            </div>
                        </div>
                    </div>
                    {{-- {{ $snapToken }} --}}
                </div>
            </div>
        </form>
        <div class="row justify-content-end mt-3">
            <div class="col-md-6 text-end">
                <div class="mb3">
                    <button type="button" class="btn btn-success" id="pay-button">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            // $('.search-select').select2();
            // ketika provinsi tujuan di klik maka auto excecute kota & kabupate sesuai id provinsi
            $('select[name="province_id"]').on('change', function() {
                // tampung nilai id provinsi yg dikirim
                let provinces = $(this).val();
            
                if(provinces) {
                    $.ajax({
                        type: "GET",
                        url: "/city/" + provinces,
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_id"], select[name="destination_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="city_id"], select[name="destination_id"]').append(
                                    '<option value="'+ value.id +'">' + value.nama_kab_kota + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="city_id"], select[name="destination_id"]').empty();
                }
            });

            $('select[name="courier"]').on('change', function() {
                let costLayanan = 2000;
                let origin = $("select[name=city_id]").val();
                let destination = $("select[name=destination_id]").val();
                let courier = $("select[name=courier]").val();
                let weight = $("input[name=weight]").val();
                let totalBelanja = $('input[name="total_belanja"]').val();

                if(courier) {
                    jQuery.ajax ({
                        url:"/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
                        type:'GET',
                        dataType:'json',
                        success:function(response) {
                            console.log(response);
                            $('select[name="cost_services"]').empty();
                            // ini untuk looping data result nya
                            response = response[0];
                                $.each(response.costs, function(key, value) {
                                    let cost = value.cost[0];
                                    $('select[name="cost_services"]').append('<option value="'+ cost.value + '">' + value.service + '-' + value.description + ' Rp. ' + cost.value + ' : ' + cost.etd + ' (days) ' + '</option>');
                                });

                            let costKurir = response.costs[0].cost[0].value;
                            // $('input[name="total_harga"]').val(parseInt(response.costs[0].cost[0].value) + parseInt(totalBelanja));
                            $('.cost-ongkir').html(`Rp. ${costKurir}`);
                            $('.cost-layanan').html(`Rp. ${costLayanan}`);
                            $('.harga').html(`Rp. ${parseInt(costKurir) + parseInt(totalBelanja) + costLayanan}`);
                        }
                    });
                }else {
                    $('select[name="cost_services"]').empty();
                }
            });

            $('select[name="cost_services"]').on('change', function(){
                let costLayanan = 2000;
                let services = $(this).val();
                let totalBelanja = $('input[name="total_belanja"]').val();
                let tampung = parseInt(totalBelanja) + parseInt(services);
                console.log(tampung);

                if(services) {
                    $('.harga').html(`Rp. ${tampung + costLayanan}`);
                    $('.cost-ongkir').html(`Rp. ${services}`);
                } 
            });
        });
    </script>
    <!-- midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.querySelector('#pay-button');
            payButton.addEventListener('click', function(e) {
                e.preventDefault();
    
                snap.pay('<?=$snapToken?>', {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        console.log(result)
                    }
                });
            });
    </script>
@endsection


