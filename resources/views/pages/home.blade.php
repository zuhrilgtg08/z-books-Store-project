@extends('layouts.main')
@section('main-content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6 mt-5">
            <h3 class="mt-3 font-semibold text-center">Cari Buku</h3>
            <form action="/home" method="GET">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif

                @if (request('penerbit'))
                    <input type="hidden" name="penerbit" value="{{ request('penerbit') }}">
                @endif

                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

                <div class="input-group mt-3">
                    <input type="text" class="form-control" name="search" placeholder="Cari Buku..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-success" type="submit" id="cari-btn">
                        <i class="fas fa-fw fa-search"></i>
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    @if ($data->count())
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-5">
                    <div class="card h-100 border-0 shadow-lg">
                        @if ($data[0]->image)
                            <img src="{{ asset('storage/' . $data[0]->image) }}" class="card-img-top" alt="{{ $data[0]->category->name }}">
                        @else
                            <img class="card-img-top" src="{{ asset('assets/images/cover-404.jpg') }}" alt="{{ $data[0]->category->name }}" />
                        @endif

                        <div class="card-body p-4 text-center">
                            <h3 class="card-title"> {{ $data[0]->judul_buku }} {{ $tag }}</h3>
                            <p>By. 
                                <small class="text-muted">
                                    <a href="/home?author={{ $data[0]->author->slug }}" class="text-decoration-none">{{ $data[0]->author->nama_author }}</a> Category 
                                    <a href="/home?category={{ $data[0]->category->slug }}" class="text-decoration-none">{{ $data[0]->category->name }}</a> Penerbit
                                    <a href="/home?penerbit={{ $data[0]->penerbit->slug }}" class="text-decoration-none">{{ $data[0]->penerbit->nama_penerbit }}</a>
                                    {{ $data[0]->created_at->diffForHumans() }}
                                </small>
                            </p>
                            <p class="card-text">{{$data[0]->excerpt}}</p>
                            <p class="card-text title h4">@currency($data[0]->harga)</p>
                            <a href="{{ route('home.info', $data[0]->id) }}" 
                                class="text-decoration-none btn btn-danger">
                                <i class="fas fa-fw fa-info-circle"></i>
                                Info Buku
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-5 container">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach ($data->skip(1) as $buku)
                        <div class="col-md-4 mb-5">
                            <div class="card h-100 border-0 shadow-lg">
                                <!-- Sale badge-->
                                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                <!-- Product image-->
                                <div class="badge bg-success text-white position-absolute" style="top: 0.5rem; left: 0.5rem">
                                    <a href="/home?category={{ $buku->category->slug }}" class="text-white text-decoration-none">{{ $buku->category->name }}</a>
                                </div>
                                @if ($buku->image)
                                    <img class="card-img-top" src="{{ asset('storage/' . $buku->image) }}" alt="cover-book" style="width: 100%; height: 100%; object-fit: cover;" />
                                @else
                                    <img class="card-img-top" src="{{ asset('assets/images/cover-404.jpg') }}" alt="cover-book" style="width: 100%; height: 100%; object-fit: cover;" />
                                @endif
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $buku->judul_buku }}</h5>
                                        <!-- description-->
                                        <p>By.
                                            <small class="text-muted">
                                                <a href="/home?author={{ $buku->author->slug }}"
                                                    class="text-decoration-none">{{ $buku->author->nama_author }}</a> Penerbit 
                                                <a href="/home?penerbit={{ $buku->penerbit->slug }}"
                                                    class="text-decoration-none">{{ $buku->penerbit->nama_penerbit }}</a>
                                                {{ $data[0]->created_at->diffForHumans() }}
                                            </small>
                                        </p>
                                        <h5 class="card-title fw-bolder">@currency($buku->harga)</h5>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <a class="btn btn-danger mt-auto"
                                            href="{{ route('home.info', $buku->id) }}">
                                            <i class="fas fa-fw fa-info-circle"></i>
                                            Info Buku
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                {!! $data->links() !!} 
            </div>
        </div>
    @else
        <div class="col-md-6 mt-3 m-auto text-center">
            <p class="fs-4 h3 mb-3">Sory, Buku Tidak ada!.</p>
        </div>
    @endif
    
    <div class="container-marketing">
        <div class="row featurette">
            <div class="col-md-7">
                <h3 class="featurette-heading fw-normal lh-1"> Buku adalah jendela dunia </h3>
                <p class="lead">
                    Melalui buku kita bisa mengetahui tentang banyak hal yang ada di dunia. Untuk mengetahui apa yang ada di perut bumi,
                    kita tidak perlu masuk ke dalam perut bumi. Tapi cukup hanya dengan membaca buku.
                </p>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('assets/images/about-us.jpg') }}" alt="carousel" class="d-block" width="500px">
            </div>
        </div>
    </div>
@endsection
