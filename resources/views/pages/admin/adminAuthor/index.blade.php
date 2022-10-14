@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.author'])
@section('admin-content')
    <h1 class="h2 mb-3 text-gray-800 text-center">Authors Managements</h1>

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
                                <a href="/admin/dashboard/author/{{ $penulis->slug }}" class="btn btn-primary"><i
                                        class="fas fa-fw fa-eye"></i></a>
                                <a href="{{ route('author.edit', $penulis->id) }}" class="btn btn-warning"><i
                                        class="fas fa-fw fa-edit"></i></a>
                                <form action="{{ route('author.destroy', $penulis->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah yakin ingin menghapus author ini ?')">
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