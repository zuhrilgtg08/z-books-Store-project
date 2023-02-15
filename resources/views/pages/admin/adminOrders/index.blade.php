@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'ordersCustomer'])
@section('admin-content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="h2 mb-3 text-gray-800 text-center">Orders Managements</h1>
    </div>
    
        @if (session()->has('success'))
            <div class="alert alert-success col-md-8 alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        @if (session()->has('errors'))
            <div class="alert alert-danger col-md-8 alert-dismissible fade show" role="alert">
                {{ session('errors') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    <div class="card-body">
        <div class="table-responsive">
            <a href="{{ route('export.data.pdf') }}" class="btn btn-danger mb-3"><i class="fas fa-fw fa-file-pdf"></i> Export Pdf</a>
            <a href="{{ route('export.pesanan.excel') }}" class="btn btn-success mb-3 d-none"><i class="fas fa-fw fa-file-excel"></i> Export Excel</a>
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-gradient-dark text-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
                        <th>Payment Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($resultOrder as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ substr($data->order->uuid, 0, -28); }}</td>
                            <td>{{ $data->buku->judul_buku }}</td>
                            <td>{{ $data->quantity }}</td>
                            <td>
                                @if($data->status == 'pending')
                                    <span class="badge badge-primary">{{ $data->status }}</span>
                                @else
                                    <span class="badge badge-success">{{ $data->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin-orders.show', $data->order->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection