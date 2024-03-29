@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.author'])
@section('admin-content')
    <h1 class="h2 mb-3 text-gray-800 text-center">Authors Managements</h1>

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
            <a href="{{ route('author.create') }}" class="btn btn-success">
                <i class="fas fa-fw fa-plus"></i>
                Add Author
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-light bg-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Author</th>
                            <th>Slug</th>
                            <th>Biografi Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($author as $penulis)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $penulis->nama_author }}</td>
                                <td>{{ $penulis->slug }}</td>
                                <td>{{ $penulis->excerpt }}</td>
                                <td>
                                    <a href="/admin/dashboard/author/{{ $penulis->slug }}" class="btn btn-primary"><i class="fas fa-fw fa-eye"></i></a>
                                    <a href="{{ route('author.edit', $penulis->id) }}" class="btn btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('author.destroy', $penulis->id) }}" method="POST" class="d-inline">
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
                    title: 'Hapus Author?',
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
                    }, 3000);
                });
            });
    </script>
@endsection