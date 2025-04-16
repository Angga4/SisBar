
    <!DOCTYPE html>
<html lang="id" class="light-mode">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPBAR - Sistem Manajemen Peminjaman Barang Sekolah</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
  
    <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
@include('landing.navbar')

    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="hero-content">
                        <h1 class="hero-title">Sistem Manajemen Peminjaman Barang Sekolah</h1>
                        <p class="hero-subtitle">Kelola peminjaman barang sekolah dengan mudah, cepat, dan efisien. catat peminjam, dan pantau pengembalian dalam satu platform terintegrasi.</p>
                        <div class="d-flex">
                            <a href="{{ route('detail_barang') }}" class="btn btn-primary btn-lg me-3">Lihat Barang</a>
                            <a href="#tentang" class="btn btn-outline-primary btn-lg">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset('img/kardus.png') }}" alt="Hero Image" class="hero-image img-fluid">
                </div>
            </div>
        </div>
        <div class="wave-bg">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="tentang">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="section-title text-center" data-aos="fade-up">Tentang SIPBAR</h2>
                    <p data-aos="fade-up" data-aos-delay="100">Sistem Manajemen peminjaman barang sekolah yang mempermudah proses peminjaman dan pengembalian barang sekolah dengan pencatatan yang terstruktur dan monitoring yang efisien.</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <img src="{{ asset('img/laptop.png') }}" alt="About Image" class="img-fluid rounded">
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <h3 class="mb-4">Permasalahan yang Kami Atasi</h3>
                    <div class="d-flex mb-3">
                        <i class="fas fa-times-circle text-danger me-3 mt-1"></i>
                        <p>Pencatatan manual yang rentan kesalahan dan tidak terorganisir</p>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fas fa-times-circle text-danger me-3 mt-1"></i>
                        <p>Kesulitan melacak barang yang dipinjam dan belum dikembalikan</p>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fas fa-times-circle text-danger me-3 mt-1"></i>
                        <p>Proses peminjaman yang memakan waktu dan tidak efisien</p>
                    </div>
                    
                    <h3 class="mb-4 mt-5">Solusi Kami</h3>
                    <div class="d-flex mb-3">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <p>Sistem pencatatan digital yang terstruktur dan sistematis</p>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <p>Pelacakan barang secara real-time dengan status yang jelas</p>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fas fa-check-circle text-success me-3 mt-1"></i>
                        <p>Proses peminjaman dan pengembalian yang cepat dan efisien</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section" id="fitur">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="section-title text-center" data-aos="fade-up">Fitur Unggulan</h2>
                    <p data-aos="fade-up" data-aos-delay="100">SIPBAR memiliki berbagai fitur yang memudahkan pengelolaan peminjaman barang di sekolah Anda.</p>
                </div>
            </div>
            <div class="row">
                <!-- Feature 1 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4 class="feature-title">Pengelolaan Data Barang</h4>
                        <p>Admin dapat dengan mudah menambahkan, mengedit, dan menghapus data barang yang tersedia untuk dipinjam dengan detail informasi yang lengkap.</p>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="feature-title">Manajemen Akun Guru</h4>
                        <p>Admin dapat membuat dan mengelola akun guru yang bertugas menangani peminjaman dan pengembalian barang dari siswa.</p>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-history"></i>
                        </div>
                        <h4 class="feature-title">Riwayat Peminjaman</h4>
                        <p>Melihat riwayat peminjaman lengkap dengan informasi peminjam, tanggal peminjaman, dan status pengembalian barang.</p>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <h4 class="feature-title">Proses Peminjaman Cepat</h4>
                        <p>Guru dapat mencatat peminjaman barang dengan cepat dan mudah, memastikan proses yang efisien tanpa hambatan.</p>
                    </div>
                </div>
                
                <!-- Feature 5 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <h4 class="feature-title">Pengelolaan Pengembalian</h4>
                        <p>Guru dapat mencatat pengembalian barang dan sistem akan secara otomatis memperbarui status barang menjadi tersedia kembali.</p>
                    </div>
                </div>
                
                <!-- Feature 6 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4 class="feature-title">Sistem Komplain</h4>
                        <p>Siswa dapat mengirimkan komplain atau feedback terkait proses peminjaman untuk perbaikan layanan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Prosedur Peminjaman -->
    <section id="prosedur" class="feature-section prosedur-section">
    <div class="container">
        <div class="row mb-50">
            <div class="col-lg-6 mx-auto text-center">
                <h2 class="section-title text-center" data-aos="fade-up">Prosedur Peminjaman (Siswa)</h2>
                <p data-aos="fade-up" data-aos-delay="100">Ikuti langkah-langkah berikut untuk meminjam barang melalui guru Anda.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="feature-title">Pilih Barang</h4>
                    <p>Cari tahu barang apa saja yang tersedia dan pilih barang yang ingin Anda pinjam.</p>
                    <small>Tips: Tanyakan kepada guru jika Anda tidak yakin.</small>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding"></i>
                    </div>
                    <h4 class="feature-title">Ajukan ke Guru</h4>
                    <p>Datangi guru yang bertanggung jawab dan ajukan permohonan peminjaman secara langsung.</p>
                    <small>Tips: Sampaikan informasi lengkap tentang barang yang ingin dipinjam.</small>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h4 class="feature-title">Pengembalian Barang</h4>
                    <p>Kembalikan barang yang dipinjam kepada guru sesuai dengan waktu yang disepakati.</p>
                    <small>Tips: Pastikan barang dikembalikan dalam kondisi baik.</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-section prosedur-section">
    <div class="container">
        <div class="row mb-50">
            <div class="col-lg-6 mx-auto text-center">
                <h2 class="section-title text-center" data-aos="fade-up">Prosedur Peminjaman (Guru)</h2>
                <p data-aos="fade-up" data-aos-delay="100">Ikuti langkah-langkah berikut untuk memproses peminjaman di sistem.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h4 class="feature-title">Verifikasi Peminjaman</h4>
                    <p>Periksa ketersediaan barang dan identitas siswa yang mengajukan peminjaman.</p>
                    <small>Tips: Pastikan semua informasi sudah benar.</small>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h4 class="feature-title">Catat di Sistem</h4>
                    <p>Masukkan data peminjaman ke dalam sistem, termasuk nama siswa, barang, dan waktu peminjaman.</p>
                    <small>Tips: Gunakan fitur pencarian untuk mempercepat proses.</small>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h4 class="feature-title">Update Status</h4>
                    <p>Perbarui status barang di sistem setelah barang dikembalikan oleh siswa.</p>
                    <small>Tips: Pastikan status barang selalu akurat.</small>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Stats Section -->
    <!-- <section class="stats-section" id="statistik">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="section-title text-center" data-aos="fade-up">Statistik Kami</h2>
                    <p data-aos="fade-up" data-aos-delay="100">Angka-angka yang menunjukkan keberhasilan sistem peminjaman barang kami.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <h3 class="stats-number">500+</h3>
                        <p class="stats-text">Barang Tersedia</p>
                    </div>
                </div>
                
           
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="stats-number">1000+</h3>
                        <p class="stats-text">Pengguna Aktif</p>
                    </div>
                </div>
                
              
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="stats-number">5000+</h3>
                        <p class="stats-text">Peminjaman Sukses</p>
                    </div>
                </div>
                
               
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <h3 class="stats-number">15+</h3>
                        <p class="stats-text">Sekolah Mitra</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Testimonials Section -->
    <section class="testimonial-section" id="testimoni">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-6 mx-auto text-center">
                    <h2 class="section-title text-center" data-aos="fade-up">Testimoni Pengguna</h2>
                    <p data-aos="fade-up" data-aos-delay="100">Apa yang dikatakan pengguna tentang sistem peminjaman barang kami.</p>
                </div>
            </div>
            <div class="row">
                <!-- Testimonial 1 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <p class="testimonial-text">SIPBAR sangat membantu saya sebagai guru yang bertanggung jawab mengelola peminjaman alat laboratorium. Proses pencatatan menjadi sangat cepat dan efisien.</p>
                        <div class="testimonial-author">
                        <i class="bi bi-person-circle testimonial-author-image"></i>
                            <div>
                                <h5 class="testimonial-author-name">Budi Santoso</h5>
                                <p class="testimonial-author-title">Guru Laboratorium</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <p class="testimonial-text">Dengan SIPBAR, kami tidak lagi kehilangan barang inventaris sekolah. Semua tercatat dengan baik dan mudah dilacak keberadaannya.</p>
                        <div class="testimonial-author">
                            <i class="bi bi-person-circle testimonial-author-image"></i>
                            <div>
                                <h5 class="testimonial-author-name">Siti Rahayu</h5>
                                <p class="testimonial-author-title">Kepala Sekolah</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card">
                        <p class="testimonial-text">Sebagai siswa, saya senang karena bisa melihat barang apa saja yang tersedia untuk dipinjam. Sistem komplain juga sangat membantu ketika ada kendala.</p>
                        <div class="testimonial-author">
                            <i class="bi bi-person-circle testimonial-author-image"></i>
                            <div>
                                <h5 class="testimonial-author-name">Dimas Pratama</h5>
                                <p class="testimonial-author-title">Siswa Kelas XII</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center" data-aos="zoom-in">
                    <h2 class="cta-title">Siap Menggunakan SIPBAR?</h2>
                    <p class="mb-4">Kelola peminjaman barang sekolah dengan lebih efisien dan terorganisir</p>
                    <a href="#" class="btn btn-light btn-lg">Mulai Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    @include('landing.footer')

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init();
        
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        
        darkModeToggle.addEventListener('change', () => {
            if (darkModeToggle.checked) {
                document.documentElement.classList.remove('light-mode');
                document.documentElement.classList.add('dark-mode');
                localStorage.setItem('dark-mode', 'true');
            } else {
                document.documentElement.classList.remove('dark-mode');
                document.documentElement.classList.add('light-mode');
                localStorage.setItem('dark-mode', 'false');
            }
        });
        
        // Check for saved dark mode preference
        if (localStorage.getItem('dark-mode') === 'true') {
            document.documentElement.classList.remove('light-mode');
            document.documentElement.classList.add('dark-mode');
            darkModeToggle.checked = true;
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>