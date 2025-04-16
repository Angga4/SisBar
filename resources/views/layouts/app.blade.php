<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Peminjaman Barang')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body class="g-sidenav-show {{ session('dark-mode') ? 'dark-version' : '' }}">
    

    <!-- Main content -->
    <main class="main-content">
        <!-- Mobile sidebar toggle button -->
        <button id="openSidebar" class="toggle-btn">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Navbar -->
        @include('layouts.navbar')
        
        @include('layouts.sidebar')
        <!-- Content -->
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });
            
            // Sidebar toggle functionality
            const sidebar = document.getElementById('sidenav-main');
            const openBtn = document.getElementById('openSidebar');
            const closeBtn = document.getElementById('closeSidebar');
            
            if (openBtn) {
                openBtn.addEventListener('click', function() {
                    sidebar.classList.add('show');
                });
            }
            
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                });
            }
            
            // Handle modals and sidebar z-index
            const modals = document.querySelectorAll('.modal');
            
            modals.forEach(modal => {
                modal.addEventListener('show.bs.modal', function() {
                    if (sidebar) {
                        sidebar.style.zIndex = '1030';
                    }
                });
                
                modal.addEventListener('hidden.bs.modal', function() {
                    if (sidebar) {
                        sidebar.style.zIndex = '1040';
                    }
                });
            });
            
            // Handle responsive sidebar
            function handleResize() {
                if (window.innerWidth <= 768) {
                    if (sidebar) {
                        sidebar.classList.remove('show');
                    }
                } else {
                    if (sidebar) {
                        sidebar.classList.add('show');
                    }
                }
            }
            
            window.addEventListener('resize', handleResize);
            handleResize(); // Call once on load
        });
    </script>

    @stack('scripts')
</body>
</html>
