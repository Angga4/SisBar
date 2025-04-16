<!-- Sidebar -->
<aside class="sidebar" id="sidenav-main">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h5 class="m-0 fw-bold text-primary">SIPBAR</h5>
        </div>

        <hr class="horizontal dark mt-0">

        <div class="sidebar-content">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(auth()->user()->role . '.dashboard') ? 'active' : '' }}"
                       href="{{ route(auth()->user()->role . '.dashboard') }}">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('barang.*') ? 'active' : '' }}"
                           href="{{ route('barang.index') }}">
                            <i class="fas fa-box me-2"></i> Manajemen Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guru.*') && !request()->routeIs('guru.peminjaman.*') && !request()->routeIs('guru.pengembalian.*') ? 'active' : '' }}"
                           href="{{ route('guru.index') }}">
                            <i class="fas fa-user me-2"></i> Manajemen Guru
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guru.peminjaman.*') ? 'active' : '' }}"
                           href="{{ route('guru.peminjaman.index') }}">
                            <i class="fas fa-hand-holding me-2"></i> Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('guru.pengembalian.*') ? 'active' : '' }}"
                           href="{{ route('guru.pengembalian.index') }}">
                            <i class="fas fa-undo-alt me-2"></i> Pengembalian
                        </a>
                    </li>
                @endif

                <li class="nav-item mt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>