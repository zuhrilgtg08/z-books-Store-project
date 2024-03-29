@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.buku'])
@section('admin-content')
    <a class="btn btn-dark" href="{{ route('buku.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">Add Buku</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-7">
                                <div class="mb-3">
                                    <label for="judul-buku" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" id="judul-buku" name="judul_buku"
                                        required value="{{ old('judul_buku') }}">
                                    @error('judul_buku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga"
                                        value="{{ old('harga') }}" required min="1">
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok"
                                        value="{{ old('stok') }}" required min="1">
                                    @error('stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="weight" class="form-label">Berat</label>
                                    <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight"
                                        value="{{ old('weight') }}" required min="1">
                                    @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Categories</label>
                                    <select class="form-control" name="category_id" id="category" required>
                                        <option value="" disabled selected>Select Category </option>
                                        @foreach ($categories as $category)
                                        <option value="{{ old('category_id', $category->id) }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="author" class="form-label">Authors</label>
                                    <select class="form-control" name="author_id" id="author" required>
                                        <option value="" disabled selected>Select Author </option>
                                        @foreach ($authors as $author)
                                        <option value="{{ old('author_id', $author->id) }}">{{ $author->nama_author }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="penerbit" class="form-label">Penerbits</label>
                                    <select class="form-control" name="penerbit_id" id="penerbit" required>
                                        <option value="" disabled selected>Select Penerbit </option>
                                        @foreach ($penerbits as $penerbit)
                                        <option value="{{ old('penerbit_id', $penerbit->id) }}">{{ $penerbit->nama_penerbit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Cover Buku</label>
                            <img class="img-preview img-fluid mb-3 sm-2">
                            <input type="file" class="form-control-file" required @error('image') is-invalid @enderror id="image"
                                name="image" onchange="previewCover()">
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sinopsis" class="form-label">Sinopsis</label>
                            <input type="hidden" class="form-control @error('sinopsis') is-invalid @enderror" id="sinopsis" name="sinopsis"
                                required value="{{ old('sinopsis') }}">
                                <trix-editor input="sinopsis"></trix-editor>
                                @error('sinopsis')
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
        function previewCover() {
                const image = document.querySelector('#image');
                const imagePreview = document.querySelector('.img-preview');
                imagePreview.style.display = 'block';
    
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
    
                oFReader.onload = function(oFREvent) {
                    imagePreview.src = oFREvent.target.result;
                }
            }
    
            document.addEventListener('trix-file-accept', function(e) {
                e.preventDefault();
            });
    </script>
@endsection