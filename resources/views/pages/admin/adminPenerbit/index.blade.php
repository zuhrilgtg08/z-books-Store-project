@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.penerbit'])
@section('admin-content')
    <h1 class="h2 mb-3 text-gray-800 text-center">Penerbit Managements</h1>

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
            <a href="{{ route('penerbit.create') }}" class="btn btn-success">
                <i class="fas fa-fw fa-plus"></i>
                Add Penerbit
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Penerbit</th>
                            <th>Nama Penerbit</th>
                            <th>Slug</th>
                            <th>Tahun Terbit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($penerbits as $penerbit)
                        <tr>
                            <td>{{ $i++; }}</td>
                            <td>{{ $penerbit->kode_terbit }}</td>
                            <td>{{ $penerbit->nama_penerbit }}</td>
                            <td>{{ $penerbit->slug }}</td>
                            <td>{{ $penerbit->tahun_terbit }}</td>
                            <td>
                                <a href="/admin/dashboard/penerbit/{{ $penerbit->slug }}" class="btn btn-primary"><i
                                        class="fas fa-fw fa-eye"></i></a>
                                <a href="{{ route('penerbit.edit', $penerbit->id) }}" class="btn btn-warning"><i
                                        class="fas fa-fw fa-edit"></i></a>
                                <form action="{{ route('penerbit.destroy', $penerbit->id) }}" method="POST"
                                    class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger sweet-delete" type="submit">
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
                    title: 'Hapus Penerbit?',
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