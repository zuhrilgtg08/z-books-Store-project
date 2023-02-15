@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.buku'])
@section('admin-content')
    <h1 class="h2 mb-3 text-gray-800 text-center">Buku Managements</h1>
    
    @if (session()->has('success'))
        <div class="alert alert-success col-md-6 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    
    @if (session()->has('errors'))
        <div class="alert alert-danger col-md-6 alert-dismissible fade show" role="alert">
            {{ session('errors') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                                    <button type="submit" class="btn btn-danger sweet-delete">
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

@section('script')
    <script>
        $('.sweet-delete').click(function(event){
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Hapus Buku?',
                    text: "Anda Yakin Ingin Menghapusnya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                }).then((result) => {
                    setTimeout(() => {
                        if(result.isConfirmed) {
                            form.submit();
                        }
                    }, 100);
                });
            });
    </script>
@endsection