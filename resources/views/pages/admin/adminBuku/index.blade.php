@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.buku'])
@section('admin-content')
    <h1 class="h2 mb-3 text-gray-800 text-center">Buku Managements</h1>
    
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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('buku.create') }}" class="btn btn-success">
                <i class="fas fa-fw fa-plus"></i>
                Add Buku
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gradient-dark text-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Buku</th>
                            <th>Judul Buku</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Cover</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($result as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->kode_buku }}</td>
                            <td>{{ $data->judul_buku }}</td>
                            <td>@currency($data->harga)</td>
                            <td>{{ $data->stok . " Buku"}}</td>
                            <td>
                                @if ($data->image)
                                    <img src="{{ asset('storage/' . $data->image) }}" alt="cover" class="img-fluid" width="100">
                                @else
                                    <img src="{{ asset('assets/images/cover-404.jpg') }}" alt="cover" class="img-fluid"
                                        width="100">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('buku.show', $data->id) }}" class="btn btn-primary"><i
                                        class="fas fa-fw fa-eye"></i></a>
                                <a href="{{ route('buku.edit', $data->id) }}" class="btn btn-warning"><i
                                        class="fas fa-fw fa-edit"></i></a>
                                <form action="{{ route('buku.destroy', $data->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah yakin ingin menghapus buku ini ?')">
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