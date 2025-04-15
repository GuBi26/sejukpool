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
    <a class="nav-link" href="{{ route('admin.petugas.index') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Kelola Petugas</span>
    </a>
</li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.user.index') }}">
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
        <a class="nav-link" href="{{ route('kelola.transaksi') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Transaksi</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kelola.voucher') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Voucher</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Logout Item (diletakkan paling bawah sidebar) -->
<li class="nav-item mt-auto">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw text-white mr-2"></i>
        <span>Logout</span>
    </a>
</li>
</ul>
<!-- End of Sidebar -->

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="top: 50%; transform: translateY(-50%);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="modal-content rounded-lg p-4">
                <div class="d-flex justify-content-end">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 24px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5 class="font-weight-bold text-primary mb-4" style="color: #4e73df;">Yakin ingin logout?</h5>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-secondary mr-2 px-4" data-dismiss="modal">No, cancel</button>
                        <button type="submit" class="btn text-white px-4" style="background-color: #4e73df;">Yes, confirm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>