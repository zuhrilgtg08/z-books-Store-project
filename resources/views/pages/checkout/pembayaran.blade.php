@extends('layouts.main')
@section('main-content')

<div class="row justify-content-center mt-5">
    <div class="col-md-4 mt-5 my-4">
        <h3 class="text-center">Konfirmasi Pembayaran Pesanan</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-md-8 alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('errors'))
        <div class="alert alert-danger col-md-8 alert-dismissible fade show" role="alert" id="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('errors') }}
        </div>
    @endif
</div>

<div class="row justify-content-center mt-3">
    <form action="" method="" class="d-inline">
        @csrf
        <div class="row g-0 d-flex justify-content-between">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body border-0 shadow-md">
                        {{-- {{ $provinsi }} --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="row justify-content-end mt-3">
    <div class="col-md-6 text-end">
        {{-- <div class="mb3">
            <button type="button" class="btn btn-success" id="pay-button">
                snapToken
            </button>
        </div>
        <form action="" id="submit_form" method="POST">
            @csrf
            <input type="hidden" name="json" id="json_callback">
        </form> --}}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                    <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong></p>
                </div>
                <div class="col-xl-3 float-end">
                    <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                            class="fas fa-print text-primary"></i> Print</a>
                    <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                            class="far fa-file-pdf text-danger"></i> Export</a>
                </div>
                <hr>
            </div>

            <div class="container">
                <div class="col-md">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/icon-books.png') }}" alt="icon-books" class="mb-2"/>
                        <h5 class="fw-normal text-success">Z-book's</h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        <ul class="list-unstyled">
                            <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
                            <li class="text-muted">Street, City</li>
                            <li class="text-muted">State, Country</li>
                            <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                        </ul>
                    </div>
                    <div class="col-xl-4">
                        <p class="text-muted">Invoice</p>
                        <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">ID:</span>#123-456</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="me-1 fw-bold">Status:</span><span
                                    class="badge bg-warning text-black fw-bold">
                                    Unpaid</span></li>
                        </ul>
                    </div>
                </div>

                <div class="row my-2 mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                        <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Description</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            <tr>
                                <th>{{ $no++ }}</th>
                                <td>{{ $dataKeranjang[0]->buku->judul_buku }}</td>
                                <td>{{ $dataKeranjang[0]->quantity }}</td>
                                <td>{{ $dataKeranjang[0]->buku->harga }}</td>
                                <td>@currency($dataKeranjang[0]->buku->harga * $dataKeranjang[0]->quantity)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-xl-8">
                        <p class="ms-3">Add additional notes and payment information</p>

                    </div>
                    <div class="col-xl-3">
                        <ul class="list-unstyled">
                            <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                        </ul>
                        <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                                style="font-size: 25px;">$1221</span></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xl-10">
                        <p>Thank you for your purchase</p>
                    </div>
                    <div class="col-xl-2">
                        {{-- <button type="button" class="btn btn-primary text-capitalize"
                            style="background-color:#60bdf3 ;">Pay Now</button> --}}
                        <button type="button" class="btn btn-primary text-capitalize" 
                            style="background-color:#60bdf3 ;" id="pay-button">
                            Pay Now
                        </button>
                        <form action="" id="submit_form" method="POST">
                            @csrf
                            <input type="hidden" name="json" id="json_callback">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <!-- midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        // let failedPay = document.querySelector('#alert');
        payButton.addEventListener('click', function () {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay('<?=$snapToken?>', {
                    onSuccess: function(result){
                    /* You may add your own implementation here */
                    // alert("payment success!"); 
                    // console.log(result);
                    send_response_to_form(result);
                },
                    onPending: function(result){
                    /* You may add your own implementation here */
                    // alert("wating your payment!"); 
                    // console.log(result);
                    send_response_to_form(result);
                },
                    onError: function(result){
                    // alert("payment failed!");
                    // failedPay;
                    // console.log(result);
                    send_response_to_form(result);
                },
                    onClose: function(){
                    // alert('you closed the popup without finishing the payment');
                }
            });
        });

        function send_response_to_form(result){
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit_form').submit();
        }
    </script>
@endsection