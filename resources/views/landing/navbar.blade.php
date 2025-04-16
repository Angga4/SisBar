<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">SIPBAR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ request()->is('/') ? '#beranda' : '/#beranda' }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ request()->is('/') ? '#tentang' : '/#tentang' }}">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ request()->is('/') ? '#fitur' : '/#fitur' }}">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ request()->is('/') ? '#prosedur' : '/#prosedur' }}">Prosedur</a>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="{{ request()->is('/') ? '#statistik' : '/#statistik' }}">Statistik</a> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ request()->is('/') ? '#testimoni' : '/#testimoni' }}">Testimoni</a>
                </li>
              
                
            </ul>
            <div class="toggle-dark-mode">
                <span class="dark-mode-text">Light</span>
                <label class="switch">
                    <input type="checkbox" id="darkModeToggle">
                    <span class="slider"></span>
                </label>
                <span class="dark-mode-text">Dark</span>
            </div>
        </div>
        
    </div>
    
    <a href="{{ route('login') }}" class="btn btn-primary btn me-3">Login</a>
                
</nav>