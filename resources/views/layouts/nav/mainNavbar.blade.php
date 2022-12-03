<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/home">
                <img src="{{ asset('assets/images/icon-books.png') }}" alt="brand" width="30" height="24"
                class="d-inline-block align-text-top">
                Z-Books
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('best-seller') ? 'active' : '' }}" href="{{ route('best-seller.books') }}">Best Seller</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('home-categories') ? 'active' : '' }}" href="/home-categories">Categories</a>
                        </li>
                        <div class="nav-item">
                            <a class="nav-link {{ Request::is('cart') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                                <i class="fas fa-fw fa-shopping-cart"></i>
                                Cart
                                @if (!empty($keranjang))
                                    <span class="badge bg-danger text-white ms-1 rounded-pill">
                                        {{ $keranjang->count() }}
                                    </span>
                                @endif
                            </a> 
                        </div>
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome Back, {{ auth()->user()->name }}
                                
                                @if (auth()->user()->image)
                                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="profile" class="rounded-circle" width="40" height="40" />
                                @else
                                    <img src="{{ asset('sbadmin/img/undraw_profile.svg') }}" alt="profile" class="rounded-circle" width="40" height="40" />
                                @endif
                                
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->status_type == 1)
                                    @can('admin')
                                        <li>
                                            <a class="dropdown-item" href="/admin/dashboard">
                                                <i class="fa-solid fa-server"></i> 
                                                Admin Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    @endcan
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile-user', Auth()->user()->id) }}">
                                            <i class="fa-solid fa-fw fa-user-pen"></i>
                                            Accout Profile
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('password-user', Auth()->user()->id) }}">
                                            <i class="fas fa-fw fa-key"></i>
                                            Password Account
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                @endif
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
</header>
