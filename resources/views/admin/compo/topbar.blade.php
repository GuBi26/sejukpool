                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                
                    <!-- Right Side of Navbar -->
                    <ul class="navbar-nav ml-auto">
                
                        <div class="topbar-divider d-none d-sm-block"></div>
                
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                                <i class="fas fa-user fa-lg"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                
                    </ul>
                
                </nav>
                
                <!-- End of Topbar -->



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
    
