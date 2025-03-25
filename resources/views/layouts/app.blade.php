<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Peminjaman Barang')</title>

    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    
</head>

<body class="g-sidenav-show {{ session('dark-mode') ? 'dark-version bg-gray-100' : 'bg-gray-100' }}">
    @include('layouts.sidebar')
    
    <main class="main-content position-relative border-radius-lg">
        @include('layouts.navbar')
        <div class="container-fluid py-4">
            @yield('content')
            
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

    
    <!-- Control Center for Argon Dashboard -->
    <script src="{{ asset('assets/js/argon-dashboard.min.js') }}"></script>
    
    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        document.addEventListener("DOMContentLoaded", function() {
            let modals = document.querySelectorAll(".modal");
            let sidebar = document.querySelector("#sidenav-main");

            if (sidebar) {
                modals.forEach(modal => {
                    modal.addEventListener("show.bs.modal", function () {
                        sidebar.style.zIndex = "0"; 
                        sidebar.classList.add("sidebar-disabled"); // Tambahkan efek blur & nonaktifkan klik
                    });

                    modal.addEventListener("hidden.bs.modal", function () {
                        sidebar.style.zIndex = "1040"; 
                        sidebar.classList.remove("sidebar-disabled"); // Kembalikan normal setelah modal ditutup
                    });
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>