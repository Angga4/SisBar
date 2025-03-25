<!DOCTYPE html>
<html lang="id" class="light-mode">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - SIPBAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet" />
</head>
<style>
    /* Gaya Kartu Barang */
.barang-card {
    border: none;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    border-radius: 12px;
    overflow: hidden;
    background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
}

.barang-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.barang-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.barang-card:hover .barang-image {
    transform: scale(1.05);
}

.barang-info {
    padding: 25px;
}

.barang-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 12px;
    color: #333;
}

.barang-details {
    font-size: 1rem;
    color: #666;
    margin-bottom: 8px;
}

.search-form {
    margin-bottom: 30px;
}

/* Dark Mode */
.dark-mode .barang-card {
    background: linear-gradient(135deg, #333, #444);
}

.dark-mode .barang-title,
.dark-mode .barang-details {
    color: #eee;
}
</style>
<body>
    @include('landing.navbar')

    <section class="container mt-5">
        <h2 class="text-center mb-4">Data Barang Tersedia</h2>
        <div class="row">
            @foreach($barang as $item)
            <div class="col-md-4 mb-4">
                <div class="card barang-card">
                    @if($item->gambar)
                    <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->nama_barang }}" class="barang-image">
                    @else
                    <div class="barang-image d-flex align-items-center justify-content-center bg-light">
                        <i class="fas fa-box fa-3x text-muted"></i>
                    </div>
                    @endif
                    <div class="barang-info">
                        <h5 class="barang-title">{{ $item->nama_barang }}</h5>
                        <p class="barang-details">Jumlah: {{ $item->jumlah_barang }} unit</p>
                        @if($item->keterangan)
                        <p class="barang-details">{{ $item->keterangan }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    @include('landing.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('assets/js/dark-mode.js') }}"></script>
    <script>
        AOS.init();

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

        if (localStorage.getItem('dark-mode') === 'true') {
            document.documentElement.classList.remove('light-mode');
            document.documentElement.classList.add('dark-mode');
            darkModeToggle.checked = true;
        }
    </script>
</body>
</html>