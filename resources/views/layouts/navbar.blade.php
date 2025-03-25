<!-- navbar.blade.php -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <button class="navbar-toggler" type="button" id="sidebarToggle" aria-controls="sidenav-main"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
        </button>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0 d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#userModal">
                            <i class="fa fa-user cursor-pointer"></i>
                            <span class="d-sm-inline d-none ms-2">{{ auth()->user()->name }}</span>
                        </a>
                    </li>
                    <!-- Modal -->
                    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel">Profil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <i class="fa fa-user-circle fa-3x mb-3"></i>
                                    <h6 class="mb-2">{{ auth()->user()->name }}</h6>
                                    <p class="text-muted">{{ auth()->user()->email }}</p>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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