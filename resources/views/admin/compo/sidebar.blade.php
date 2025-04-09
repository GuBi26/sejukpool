<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="d-flex align-items-center">
        <img src="{{ asset('../content/images/undraw_profile.svg') }}" class="rounded-circle" alt="Profile"
             style="width: 40px; height: 40px; object-fit: cover; margin-right: 8px;">
             <div class="d-flex flex-column text-left sidebar-text">
                <span class="text-white font-weight-bold" style="font-size: 12px;">
                    {{ strtoupper(Auth::user()->role ?? 'ADMINISTRATOR') }}
                </span>
                <span class="text-white" style="font-size: 12px;">
                    {{ strtoupper(Auth::user()->nama ?? 'ADMIN') }}
                </span>
            </div>
            
    </div>
</a>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Kelola
    </div>

<!-- Nav Item - Kelola Petugas -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('kelola.petugas') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Kelola Petugas</span>
    </a>
</li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('kelola.user') }}">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Kelola Pengguna</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('tiket') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Tiket</span>
        </a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Transaksi</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Voucher</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->