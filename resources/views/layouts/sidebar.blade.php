<!-- sidebar.blade.php -->



<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <span class="ms-1 font-weight-bold">Sistem Peminjaman Barang</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(auth()->user()->role . '.dashboard') ? 'active' : '' }}"
                    href="{{ route(auth()->user()->role . '.dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-tv text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('barang.index') ? 'active' : '' }}"
                        href="{{ route('barang.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-box text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.index') ? 'active' : '' }}"
                        href="{{ route('guru.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Manajemen Guru</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.peminjaman.index') ? 'active' : '' }}"
                        href="{{ route('guru.peminjaman.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Peminjaman Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.pengembalian.index') ? 'active' : '' }}"
                        href="{{ route('guru.pengembalian.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-curved-next text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengembalian Barang</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>