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
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-gradient-dark text-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        {{-- <th>Kota</th> --}}
                        {{-- <th>Alamat</th> --}}
                        <th>Payment Status</th>
                        <th>Total Harga</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($resultOrder as $order)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $order->uuid }}</td>
                            {{-- <td>{{ $order->nama_kab_kota }}</td> --}}
                            {{-- <td>{{ $order->alamat }}</td> --}}
                            <td>
                                @if($order->keranjang->status == 'pending')
                                    <span class="badge badge-primary">{{ $order->keranjang->status }}</span>
                                @else
                                    <span class="badge badge-success">{{ $order->keranjang->status }}</span>
                                @endif
                            </td>
                            <td>@currency($order->harga_ongkir + $order->total_belanja)</td>
                            <td>
                                <a href="" class="btn btn-success"><i class="fas fa-fw fa-print"></i></a>
                                <a href="{{ route('admin-orders.show', $order->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-eye"></i></a>
                                <form action="{{ route('admin-orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit"
                                        onclick="return confirm('Apakah yakin ingin menghapus pesanan ini ?')">
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
@endsection