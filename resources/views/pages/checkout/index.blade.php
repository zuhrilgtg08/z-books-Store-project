@extends('layouts.main')
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-4 mt-5 my-4">
            <h3 class="text-center">Halo Checkout</h3>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-10 mt-4 m-auto">
            <form action="{{ route('tes') }}" method="POST" class="d-inline">
            {{-- <form action="" method="POST" class="d-inline"> --}}
                @csrf
                <div class="row g-0 justify-content-between">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body border-0 shadow-md">
                                <div class="mb-3">
                                    <label for="province" class="form-label">Provinsi Tujuan</label>
                                    <select class="form-select" name="province_id" id="province_id">
                                        <option selected>Provinsi Tujuan</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item['province_id'] }}">{{ $item['province'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="mb-3">
                                    <label for="city" class="form-label">Kota Asal</label>
                                    <select class="form-select" name="city_id" id="city_id">
                                        <option selected>Kota Asal</option>
                                    </select>
                                </div>
        
                                <div class="mb-3">
                                    <label for="city" class="form-label">Kota Tujuan</label>
                                    <select class="form-select" name="destination_id" id="city_id">
                                        <option>Kota Tujuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body border-0 shadow-md">
                                <div class="mb-3">
                                    <label for="courier" class="form-label">Pilih Ekspedisi</label>
                                    <select class="form-select" name="courier" id="courier">
                                        <option selected>Pilih Kurir</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS INDONESIA</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="weight" class="form-label">Weight</label>
                                    <input type="number" name="weight" id="weight" class="form-control" value="200" />
                                </div>
                    
                                <div class="mb-3">
                                    <label for="services" class="form-label">Pilih Layanan</label>
                                    <select class="form-select" name="services" id="services">
                                        <option selected>Pilih Layanan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Send</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            // ketika provinsi tujuan di klik maka auto excecute kota & kabupate sesuai id provinsi
            $('select[name="province_id"]').on('change', function() {
                // tampung nilai id provinsi yg dikirim
                let provinceId = $(this).val();

                if(provinceId) {
                    $.ajax({
                        type: "GET",
                        url: "/city/" + provinceId,
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_id"], select[name="destination_id"]').empty();
                            $.each(response, function(key, value) {
                                $('select[name="city_id"], select[name="destination_id"]').append(
                                    '<option value="'+ value.city_id +'">' + value.type + ' ' + value.city_name + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    // $('select[name="city_id"]').val('Data Tidak Ada');
                    $('select[name="city_id"], select[name="destination_id"]').empty();
                }
            });

            $('select[name="courier"]').on('change', function() {
                let origin = $("select[name=city_id]").val();
                let destination = $("select[name=destination_id]").val();
                let courier = $("select[name=courier]").val();
                let weight = $("input[name=weight]").val();
                if(courier) {
                    jQuery.ajax ({
                        url:"/origin="+origin+"&destination="+destination+"&weight="+weight+"&courier="+courier,
                        type:'GET',
                        dataType:'json',
                        success:function(response) {
                            console.log(response);
                            $('select[name="services"]').empty();
                            // ini untuk looping data result nya
                            $.each(response, function(key, value) {
                                $.each(value.costs, function(key1, value1) {
                                    $.each(value1.cost, function(key2, value2) {
                                        // $('select[name="services"]').append('<option value="'+ key +'">' + value1.service + '-' + value1.description + ' Rp. ' + value2.value + ' : ' + value2.etd + ' (days)' +'</option>');
                                        $('select[name="services"]').append('<option value="'+ key + ' ' + value1.service + '-' + value1.description + ' Rp. ' + value2.value + ' : ' + value2.etd + ' (days) ' + '">' 
                                                + value1.service + '-' + value1.description + ' Rp. ' + value2.value + ' : ' + value2.etd + ' (days) ' + '</option>');
                                    });
                                });
                            });
                        } 
                    });
                }else {
                    $('select[name="services"]').empty();
                }
            });
        });
    </script>
@endsection