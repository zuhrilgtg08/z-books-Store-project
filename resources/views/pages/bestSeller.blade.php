@extends('layouts.main', ['title' => 'Best Seller'])
@section('main-content')
    <style>
        .filter-container {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .filter-container input {
            border: 1px solid #ddd;
            width: 4.3rem;
            text-align: center;
            height: 30px;
            border-radius: 5px;
        }

        .filter-container button {
            background: #51a179;
            color: #fff;
            padding: 5px 20px;
        }

        .filter-container button:hover {
            background: #2e7552;
            color: #fff;
        }
    </style>


    <div class="row justify-content-center mt-5">
        <div class="col-md-4 my-5">
            <h2 class="text-center">Best Seller Books</h2>
        </div>
    </div>
    <div class="row position-relative justify-content-start">
        <div class="col-md-2 position-fixed">
            <h5 class="fw-bold">Filter Harga : </h5>
            <form action="{{ route('best-seller.books') }}" method="POST">
                @csrf
                <div class="row filter-container">
                    <div class="col-md-4 mb-3">
                        <input id="min_range" name="harga_min" value="{{ $filter_harga_min ?? $harga_min }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input id="max_range" name="harga_max" value="{{ $filter_harga_max ?? $harga_max }}" readonly>
                    </div>
                    <div id="slider-range"></div>
                    <div class="col-md-4 mt-3">
                        <button type="submit" class="btn btn-sm">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-end">
        <div class="col-lg-10">
            <div class="py-5 container">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        @if ($bukus->count())
                            @foreach ($bukus as $data)
                            <div class="col-md-4 mb-5">
                                <div class="card h-100 border-0 shadow-lg">
                                    <!-- Product image-->
                                    @if ($data->image)
                                        <img class="card-img-top" src="{{ asset('storage/' . $data->image) }}" alt="cover-book"
                                            style="width: 100%; height: 100%; object-fit: cover;" />
                                    @else
                                        <img class="card-img-top" src="{{ asset('assets/images/cover-404.jpg') }}" alt="cover-book"
                                            style="width: 100%; height: 100%; object-fit: cover;" />
                                    @endif
                                    <!-- Product details-->
                                    <div class="card-body p-2">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h6 class="fw-semibold">{{ $data->judul_buku }}</h6>
                                            <!-- Product Rating-->
                                            <p class="mt-1">
                                                Rating : {{ $data->star_rating }}
                                                <i class="fas fa-fw fa-star text-warning"></i>
                                            </p>
                                            <!-- Product price-->
                                            <span class="fw-bolder badge text-bg-success fs-6 mb-3">@currency($data->harga)</span>
                                        </div>
                                    </div>
                                    <!-- Product button cart-->
                                    <div class="card-footer p-2 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            {{-- <form action="{{ url('/add-pesanan', $data->id) }}" method="POST"> --}}
                                                {{-- @csrf --}}
                                                <button type="submit" class="btn btn-outline-primary mt-auto">
                                                    Add To Cart
                                                </button>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="col-md-4 mb-5">
                                <h3 class="text-center fw-normal mb-5 my-5 m">Book is Not Found!</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $( "#slider-range" ).slider({
                range: true,
                min: {{ Js::from($harga_min) }},
                max: {{ Js::from($harga_max) }},
                values: [{{ Js::from($filter_harga_min) }}, {{ Js::from($filter_harga_max) }}],
                slide:function(event, ui){
                    $("#min_range").val(ui.values[0]);
                    $('#max_range').val(ui.values[1]);
                }
            });
        });
    </script>
@endsection