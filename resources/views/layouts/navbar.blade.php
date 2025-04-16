<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur">
    <div class="container-fluid py-1 px-3">
        <div class="d-flex align-items-center">
            <h6 class="font-weight-bolder mb-0">
                @if(request()->routeIs('*.dashboard'))
                    Dashboard
                @elseif(request()->routeIs('barang.*'))
                    Manajemen Barang
                @elseif(request()->routeIs('guru.*') && !request()->routeIs('guru.peminjaman.*') && !request()->routeIs('guru.pengembalian.*'))
                    Manajemen Guru
                @elseif(request()->routeIs('guru.peminjaman.*'))
                    Peminjaman Barang
                @elseif(request()->routeIs('guru.pengembalian.*'))
                    Pengembalian Barang
                @else
                    Sistem Peminjaman Barang
                @endif
            </h6>
        </div>
        
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="nav-link text-body p-0 d-flex align-items-center" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none ms-1">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <span class="dropdown-item-text text-muted">
                            <small>{{ auth()->user()->email }}</small>
                        </span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script type="text/javascript">
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        const sidenav = document.getElementById('sidenav-main');
        sidenav.classList.toggle('d-none'); // Toggle the 'd-none' class to show/hide the sidebar
        console.log(sidenav);
    });
</script>
