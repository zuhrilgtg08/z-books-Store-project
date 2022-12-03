@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.categories'])
@section('admin-content')
    <h1 class="h2 mb-3 text-gray-800 text-center">Category Managements</h1>

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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('categories.create') }}" class="btn btn-success">
                <i class="fas fa-fw fa-plus"></i>
                Add Category
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-light bg-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($category as $c)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->slug }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-warning"><i
                                            class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('categories.destroy', $c->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus category ini?')"><i
                                                class="fas fa-fw fa-trash"></i></button>
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