<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center">
    <div class="text-center">
        <div class="text-white font-weight-bold" style="font-size: 12px;">
            {{ strtoupper(Auth::user()->role ?? 'ADMINISTRATOR') }}
        </div>
        <div class="text-white" style="font-size: 12px;">
            {{ strtoupper(Auth::user()->nama ?? 'ADMIN') }}
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
        <i class="fas fa-fw fa-user-shield"></i>
        <span>Data Petugas</span>
    </a>
</li>


<!-- Nav Item - Data Customer -->
<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.user.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Data Customer</span>
    </a>
</li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur
    </div>

<!-- Nav Item - Data Tiket -->
<li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('admin.tiket.index') }}">
        <i class="fas fa-fw fa-ticket-alt"></i>
        <span>Data Tiket</span>
    </a>
</li>

<!-- Nav Item - Data Transaksi -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('kelola.transaksi') }}">
        <i class="fas fa-fw fa-exchange-alt"></i>
        <span>Data Transaksi</span>
    </a>
</li>

<!-- Nav Item - Data Voucher -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.voucher.index') }}">
        <i class="fas fa-fw fa-gift"></i>
        <span>Data Voucher</span>
    </a>
</li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

<!-- Nav Item - Laporan -->
<li class="nav-item">
    <a class="nav-link" href="{{ route ('show.report') }}">
        <i class="fas fa-fw fa-file-alt"></i> <!-- Changed to file-alt for reports -->
        <span>Laporan</span>
    </a>
</li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
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