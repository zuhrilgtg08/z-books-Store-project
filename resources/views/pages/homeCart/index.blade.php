@extends('layouts.main')
@section('main-content')
    <div class="row mt-4 my-5">
        <h2 class="text-center font-semibold mt-5">Cart Books</h2>
        <div class="col-md-4 mt-4">
            <a class="btn btn-dark" href="{{ url('/best-seller') }}">
                <i class="fas fa-fw fa-arrow-left"></i>
                Continue Shop
            </a>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif
        
        @if (session()->has('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('delete') }}
            </div>
        @endif
    </div>

    <div class="row justify-content-center my-5 mt-3">
        <div class="col-md-12 mt-4">
            <table class="table table-striped text-center table-bordered">
                <thead class="bg-dark text-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Harga</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php $no = 1; @endphp
                    @foreach ($cart as $item)
                        <tr class="align-content-center">
                            <td scope="row">{{ $no++ }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->options->image) }}" 
                                    alt="cover" class="img-fluid" width="100"/>
                            </td>
                            <td><h5>{{ $item->name }}</h5></td>
                            <td><h5>{{ $item->options->kode_buku }}</h5></td>
                            <!-- Update Cart -->
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $item->rowId }}" name="rowId" />
                                <input type="hidden" value="{{ $item->id }}" name="id" />
                                <td>
                                    <div class="col-md-6 m-auto">
                                        <input type="number" value="{{ $item->qty }}" name="quantity" min="1" max="{{ $item->options->stok }}" 
                                            class="form-control text-center qty" />
                                    </div>
                                </td>
                                <td>
                                    <h5>@currency($item->price)</h5>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success">
                                        <i class="far fa-fw fa-edit"></i> Update
                                    </button>
                                </td>
                            </form>
                            <!-- End Update Cart -->
                            <!-- Remove Cart -->
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <td>
                                    <input type="hidden" value="{{ $item->rowId }}" name="rowId" />
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin di hapus?')">
                                        <i class="fas fa-fw fa-trash-alt"></i> Remove
                                    </button>
                                </td>
                            </form>
                            <!-- End Remove Cart -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-end mt-3 my-3">
        <div class="col-md-4 text-end mt-3">
            <a href="{{ route('checkout.index') }}" class="btn btn-warning text-end" id="checkout">
                <i class="fas fa-fw fa-money-check"></i> Checkout
            </a>
        </div>
    </div>

    <div class="row justify-content-end mt-3">
        <div class="col-md-6 mt-3">
            <h3 class="text-end">Total : @currency(Cart::priceTotal())</h3>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let qty = document.getElementsByClassName("qty");
        let btnCheckout = document.querySelector("#checkout");
        
        Array.from(qty).forEach(q => q.addEventListener('change', function() {
            btnCheckout.classList.add('disabled');
        }));
    </script>
@endsection