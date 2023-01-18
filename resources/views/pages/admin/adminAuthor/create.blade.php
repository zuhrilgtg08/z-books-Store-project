@extends('dashboard.layouts.admin', ['sbMaster' => true, 'sbActive' => 'data.author'])
@section('admin-content')
    <a class="btn btn-dark" href="{{ route('author.index') }}">
        <i class="fas fa-fw fa-arrow-left"></i>
        Back
    </a>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-5">
                <div class="card-header">
                    <h1 class="h2 text-gray-800 text-center">Add Author</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama-author" class="form-label">Nama Author</label>
                            <input type="text" class="form-control @error('nama_author') is-invalid @enderror"
                                id="nama-author" name="nama_author" required value="{{ old('nama_author') }}">
                                @error('nama_author')
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
                            <label for="image" class="form-label">Profile</label>
                            <img class="img-preview img-fluid mb-3 sm-2">
                            <input type="file" class="form-control-file" required @error('image') is-invalid @enderror
                                id="image" name="image" onchange="previewProfile()">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="biografi-author" class="form-label">Biografi Author</label>
                            <input type="hidden" class="form-control @error('biografi_author') is-invalid @enderror"
                                id="biografi-author" name="biografi_author" required value="{{ old('biografi_author') }}">
                                <trix-editor input="biografi-author"></trix-editor>
                                @error('biografi_author')
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
        const title = document.querySelector('#nama-author');
            const slug = document.querySelector('#slug');

            title.addEventListener('change', function(){
                fetch('/admin/dashboard/author/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
            });

            document.addEventListener('trix-file-accept', function(e) {
                e.preventDefault();
            });

            function previewProfile() {
                const image = document.querySelector('#image');
                const imagePreview = document.querySelector('.img-preview');
                imagePreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imagePreview.src = oFREvent.target.result;
                }
            }
    </script>
@endsection