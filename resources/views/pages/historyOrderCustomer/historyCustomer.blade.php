@extends('layouts.main')
@section('main-content')
    <main class="py-4">
        <div class="my-5 text-center mb-5">
            <h3>Riwayat Pesanan</h3>
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

        @if (session()->has('pending'))
            <div class="alert alert-warning col-md-6 alert-dismissible fade show" role="alert" id="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('pending') }}
            </div>
        @endif

        <div class="card border-0 shadow-lg my-5">
            <div class="card-body">
                <div class="container">
                    <div class="container">
                        <div class="col-md d-flex mb-4">
                            <div class="d-flex align-items-end">
                                <img src="{{ asset('assets/images/icon-books.png') }}" alt="icon-books" class="img-fluid" />
                                <h4 class="fw-normal text-success" style="margin-left: .5rem;">Z-book's </h4>
                            </div>
                        </div>

                        <div class="row text-center justify-content-center">
                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-white bg-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Buku</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($resultOrder as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->buku->judul_buku }}</td>
                                            <td>{{ $item->quantity}}</td>
                                            <td>@currency($item->buku->harga * $item->quantity)</td>
                                            <td>
                                                @if($item->order->transaction_status == 'pending')
                                                    <span class="badge bg-warning text-black">{{ $item->order->transaction_status }}</span>
                                                @else
                                                    <span class="badge bg-success">{{ $item->order->transaction_status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('customer_order_history.show', $item->order->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-info"></i></a>

                                                @if($item->order->transaction_status == 'settlement')
                                                    <a href="{{ route('history.detailExport', $item->order->id) }}" class="btn btn-success"><i class="fas fa-fw fa-print"></i></a>
                                                @elseif($item->order->transaction_status == 'pending')
                                                    <a href="{{ route('checkout.pembayaran') }}" class="btn btn-warning"><i class="fas fa-fw fa-wallet"></i></a>
                                                @endif
                                                
                                                <form action="{{ route('customer_order_history.destroy', $item->id) }}" method="POST" class="d-none">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger d-none" type="submit" onclick="return confirm('Apakah yakin ingin menghapus pesanan ini ?')">
                                                        <i class="fas fa-fw fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#dataTable').DataTable();
        });
    </script>
@endsection