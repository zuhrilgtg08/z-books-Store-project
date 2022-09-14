@extends('dashboard.layouts.admin', ['title' => 'Add Penerbit', 'sbMaster' => true, 'sbActive' => 'data.penerbit'])
@section('admin-content')
    <a class="btn btn-dark" href="{{ route('penerbit.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">Add Penerbit</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('penerbit.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama-penerbit" class="form-label">Nama Penerbit</label>
                            <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror"
                                id="nama-penerbit" name="nama_penerbit" required value="{{ old('nama_penerbit') }}">
                            @error('nama_penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun-terbit" class="form-label">Tahun Terbit</label>
                            <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                id="tahun-terbit" name="tahun_terbit" required value="{{ old('tahun_terbit') }}">
                            @error('tahun_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const title = document.querySelector('#nama-penerbit');
            const slug = document.querySelector('#slug');

            title.addEventListener('change', function(){
                fetch('/admin/dashboard/penerbit/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
            });
    </script>
@endsection