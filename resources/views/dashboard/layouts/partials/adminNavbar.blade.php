<!-- Topbar -->
<nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        @auth
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white-600 small"> Welcomeback,
                    {{ auth()->user()->name }}</span>
                {{-- <img class="img-profile rounded-circle" src="/sbadmin/img/undraw_profile.svg"> --}}
                @if (auth()->user()->image)
                    <div style="max-height:350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="profile"
                            class="img-profile rounded-circle">
                    </div>
                @else
                    <img src="{{ asset('sbadmin/img/undraw_profile.svg') }}" alt="profile"
                        class="img-profile rounded-circle">
                @endif
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/home">
                    <i class="fas fa-fw fa-home fa-sm fa-fw mr-2"></i>
                    Home
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('profile-admin', Auth()->user()->id) }}">
                    <i class="fas fa-fw fa-user fa-sm fa-fw mr-2"></i>
                    Profile Admin
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('password-admin', Auth()->user()->id) }}">
                    <i class="fas fa-fw fa-user-lock fa-sm fa-fw mr-2"></i>
                    Changes Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                </a>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}"><i
                    class="bi bi-person-circle"></i> Login</a>
        </li>
        @endauth
    </ul>
</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/logout" method="POST">
                @csrf
                <div class="modal-body">Are You sure to Logout in Dashboard pages ? </div>
                <div class="modal-footer">
                    <a class="btn btn-dark" data-dismiss="modal" href="#">Cancel</a>
                    <button type="submit" class="btn btn-danger">Logout</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end logout -->