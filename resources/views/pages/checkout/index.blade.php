@extends('layouts.main')

@section('main-content')
    <main>
        <div class="py-5 text-center">
            <h3>Buat Pesanan</h3>
        </div>

        <div class="row g-5">
            <div class="col-md-7 col-lg-8 order-md-last">
                <h4 class="mb-3 text-center">Input Data Pesanan</h4>
                <form class="d-inline" action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" />
                    <input type="hidden" value="{{ $totalBelanja }}" name="total_belanja" />
                    <input type="hidden" value="settlement" name="settlement" />
                    
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nama Pemesan : </label>
                            <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" disabled readonly />
                        </div>
            
                        <div class="col-sm-6">
                            <label for="phone" class="form-label">Nomor Hp :</label>
                            <input type="number" class="form-control" id="phone" value="{{ old('phone') }}" name="phone" min="0" />
                        </div>
            
                        <div class="col-sm-6">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" disabled readonly />
                        </div>

                        <div class="col-sm-6">
                            <label for="weight" class="form-label">Total Berat :</label>
                            <input type="text" id="weight" class="form-control text-danger fw-bold" value="{{ $totalBerat / 1000 }} Kg" disabled />
                            <input type="hidden" name="weight" id="weight" class="form-control" value="{{ $totalBerat }}" />
                        </div>

                        <div class="col-md-6">
                            <label for="province" class="form-label">Provinsi Tujuan :</label>
                            <select class="form-select" name="province_id" id="province" required>
                                <option value="" selected disabled>Provinsi Tujuan</option>
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
            
                        <div class="col-md-6">
                            <label for="courier" class="form-label">Pilih Kurir :</label>
                            <select class="form-select" name="courier" id="courier" required>
                                <option disabled selected>Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS INDONESIA</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="services" class="form-label">Pilih Layanan :</label>
                            <select class="form-select" name="harga_ongkir" id="services" required>
                                <option selected value="">Pilih Layanan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat :</label>
                            <textarea class="form-control" placeholder="Tulis Alamat" id="alamat" style="height: 100px" name="alamat" required>{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-fw fa-check"></i> 
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 col-lg-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Pesanan Anda</span>
                </h4>
                @foreach ($itemData as $item)
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item->buku->judul_buku }}</h6>
                                <small class="text-danger">Kode Buku : {{ $item->buku->kode_buku }}</small>
                            </div>
                            <span class="text-danger">{{$item->quantity }} item </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (Rp)</span>
                            <strong>@currency($totalBelanja)</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Ongkos Kirim </span>
                            <strong class="cost-ongkir">Rp. 0</strong>
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
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
                                console.log(response);
                                response = response[0];
                                    $.each(response.costs, function(key, value) {
                                        let cost = value.cost[0];
                                        $('select[name="harga_ongkir"]').append('<option value="'+ cost.value + '">' + value.service + '-' + value.description + ' Rp. ' + cost.value + ' : ' + cost.etd + ' (days) ' + '</option>');
                                    });
                                let costKurir = response.costs[0].cost[0].value;
                                $('.cost-ongkir').html(`Rp. ${costKurir}`);
                            }
                        });
                    }else {
                        $('select[name="harga_ongkir"]').empty();
                    }
                });

                $('select[name="harga_ongkir"]').on('change', function(){
                    let services = $(this).val();
                    $('.cost-ongkir').html(`Rp. ${services}`);
                });
            });
    </script>
@endsection

{{-- <div class="row justify-content-center mt-3">
    <form action="{{ route('checkout.store') }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">

        <div class="row g-0 d-flex justify-content-between">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body border-0 shadow-md">
                        <div class="mb-3">
                            <label for="province" class="form-label">Provinsi Tujuan :</label>
                            <select class="form-select" name="province_id" id="province" required>
                                <option value="" selected disabled>Provinsi Tujuan</option>
                                @foreach ($provinces as $item)
                                    <option value="{{ $item->id }}">{{ $item['name_province'] }}</option>
                                @endforeach 
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">Kota Tujuan :</label>
                            <select class="form-select" name="destination_id" id="destination" required>
                                <option>Kota Tujuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="courier" class="form-label">Pilih Ekspedisi :</label>
                            <select class="form-select" name="courier" id="courier" required>
                                <option disabled selected>Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS INDONESIA</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity Total :</label>
                            <input type="hidden" name="quantity" id="qty" class="form-control" value="{{ $qty_Total }}" />
                            <input type="text" id="qty" class="form-control text-danger fw-bold" value="{{ $qty_Total }} Jumlah" disabled /> 
                        </div>

                        <div class="mb-3">
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Subheading</div>
                                        Content for list item
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
                                </li>
                            </ol>
                        </div>

                        <div class="mb-3">
                            <label for="total_belanja" class="form-label">Sub Total Harga</label>
                            <input type="hidden" name="total_belanja" value="" class="form-control" />
                            <input type="text" value="" class="form-control text-danger fw-bold" readonly
                                disabled /> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body border-0 shadow-md">
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="hidden" name="weight" id="weight" class="form-control"
                                value="{{ $totalBerat }}" />
                            <input type="text" id="weight" class="form-control text-danger fw-bold"
                                value="{{ $totalBerat / 1000 }} kg" disabled />
                        </div>

                        <div class="mb-3">
                            <label for="services" class="form-label">Pilih Layanan</label>
                            <select class="form-select" name="harga_ongkir" id="services" required>
                                <option selected value="">Pilih Layanan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat :</label>
                            <textarea class="form-control" placeholder="Tulis Alamat" id="alamat"
                                style="height: 100px" name="alamat" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <h5 class="fw-normal">Biaya Ongkir : <span class="cost-ongkir text-success fw-bold">0</span></h5>
                    <h5 class="fw-normal">Total Pesanan : <span class="harga text-success fw-bold">0</span></h5>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-md-6 text-end">
                        <div class="mb3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-fw fa-check"></i>
                                Konfirmasi Pesanan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> --}}


