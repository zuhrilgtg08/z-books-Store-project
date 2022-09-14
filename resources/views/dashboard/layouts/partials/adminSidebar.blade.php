<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- toggled class-->
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fw fa-database"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ isset($sbActive) && $sbActive === 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="/admin/dashboard">
            <i class="fas fw fa-chart-line"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    {{-- <li class="nav-item {{ isset($sbActive) && $sbActive === 'adminProfile' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('profile-super.edit', Auth()->user()->id) }}">
        <i class="fas fa-user-alt"></i>
        <span>Profile</span>
    </a>
    </li> --}}
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link {{ isset($sbMaster) && $sbMaster === true ? '' : 'collapsed'}}" href="#"
            data-toggle="collapse" data-target="#master-data"
            aria-expanded="{{ isset($sbMaster) && $sbMaster === true ? 'true' : 'false' }}" aria-controls="master-data">
            <!--collapsed class-->
            <i class="fas fw fa-server"></i>
            <span>Master Data</span>
        </a>

        <div id="master-data" class="collapse {{ isset($sbMaster) && $sbMaster === true ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <!-- show class-->
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-dark">All Data</h6>
                <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.customer' ? 'active' : '' }}"
                href="{{ route('customer.index') }}">Customers</a>
                <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.buku' ? 'active' : '' }}"
                    href="{{ route('buku.index') }}">Buku</a>
                <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.categories' ? 'active' : '' }}"
                    href="{{ route('categories.index') }}">Categories</a>
                <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.author' ? 'active' : '' }}"
                    href="{{ route('author.index') }}">Author</a>
                <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.penerbit' ? 'active' : '' }}"
                    href="{{ route('penerbit.index') }}">Penerbit</a>
                <!--active class-->
                <a class="collapse-item {{ isset($sbActive) && $sbActive === 'data.comments' ? 'active' : '' }}"
                href="#">Comments</a>
            </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ isset($sbActive) && $sbActive === 'historyOrder' ? 'active' : '' }}">
        <a class="nav-link" href="#">
            <i class="fas fw fa-history"></i>
            <span>History Order</span>
        </a>
    </li>
    <hr class="sidebar-divider my-0">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<script>
    const sidebarToggle = document.querySelector('#sidebarToggle');
    const accordionSidebar = document.querySelector('#accordionSidebar');

    sidebarToggle.addEventListener('click', function(){
        accordionSidebar.classList.toggle('toggled');
    });
</script>
<!-- End of Sidebar -->