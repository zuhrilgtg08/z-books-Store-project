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
                            <a class="nav-link {{ ($title === "Home") ? 'active' : '' }}" href="/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($title === "About Us") ? 'active' : '' }}" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($title === "Best Seller") ? 'active' : '' }}" href="/best-seller">Best Seller</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($title === "Book Categories") ? 'active' : '' }}" href="">Categories</a>
                        </li>
                        <div class="nav-item">
                            <a class="nav-link" href="">
                                <i class="fas fa-fw fa-shopping-cart"></i>
                                Cart
                                <span class="badge bg-danger text-white ms-1 rounded-pill">0</span>
                            </a>
                        </div>
                    </ul>


                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mr-3">
                            {{-- <a class="btn btn-secondary position-relative" href="">
                                <i class="fas fa-shopping-cart fa-fw"></i>
                                Cart
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    1
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a> --}}
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome Back, {{ auth()->user()->name }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if(auth()->user()->status_type == 1)
                                    @can('admin')
                                        <li>
                                            <a class="dropdown-item" href="/admin/dashboard">
                                                <i class="fa-solid fa-server"></i> 
                                                Admin Dashboard</a>
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
