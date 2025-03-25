 <!-- Footer Section -->
 <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-logo">SIPBAR</h3>
                    <p>Sistem Peminjaman Barang Sekolah yang efisien, mudah digunakan, dan membantu proses inventarisasi sekolah menjadi lebih teratur.</p>
                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5 class="mb-4">Tautan</h5>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="{{ request()->is('/') ? '#beranda' : '/#beranda' }}">Beranda</a></li>
                        <li class="footer-link"><a href="{{ request()->is('/') ? '#tentang' : '/#tentang' }}">Tentang</a></li>
                        <li class="footer-link"><a href="{{ request()->is('/') ? '#fitur' : '/#fitur' }}">Fitur</a></li>
                        <li class="footer-link"><a href="{{ request()->is('/') ? '#statistik' : '/#statistik' }}">Statistik</a></li>
                        <li class="footer-link"><a href="{{ request()->is('/') ? '#testimoni' : '/#testimoni' }}">Testimoni</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5 class="mb-4">Fitur</h5>
                    <ul class="footer-links">
                        <li class="footer-link">Pengelolaan Barang</li>
                        <li class="footer-link">Peminjaman</li>
                        <li class="footer-link">Pengembalian</li>
                        <li class="footer-link">Riwayat</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <h5 class="mb-4">Kontak</h5>
                    <ul class="footer-links">
                        <li class="footer-link"><i class="fas fa-map-marker-alt me-2"></i> Jl. Pendidikan No. 123, Malang</li>
                        <li class="footer-link"><i class="fas fa-phone me-2"></i> (021) 1234-5678</li>
                        <li class="footer-link"><i class="fas fa-envelope me-2"></i> anggaabi04@gmai.com</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-lg me-3" data-bs-toggle="modal" data-bs-target="#complaintModal">Komplain </a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 SIPBAR - Sistem Peminjaman Barang Sekolah. All Rights Reserved.</p>
            </div>
        </div>
        
    </footer>
<div class="modal fade" id="complaintModal" tabindex="-1" aria-labelledby="complaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="complaintModalLabel">Formulir Komplain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="complaintForm">
                    <div class="mb-3">
                        <label for="complaintName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="complaintName" required>
                    </div>
                    <div class="mb-3">
                        <label for="complaintEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="complaintEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="complaintMessage" class="form-label">Pesan Komplain</label>
                        <textarea class="form-control" id="complaintMessage" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komplain</button>
                </form>
            </div>
        </div>
    </div>
</div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init("TQZO6Z_qZUCvkoUpD");
        })();
    </script>

    <script>
        document.getElementById('complaintForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('complaintName').value;
    const email = document.getElementById('complaintEmail').value;
    const message = document.getElementById('complaintMessage').value;

    const templateParams = {
        name: name,
        email: email,
        message: message
    };

    emailjs.send('service_4omay0h', 'template_zagqhqf', templateParams) // Ganti dengan Service ID dan Template ID Anda
        .then(function(response) {
            console.log('SUCCESS!', response.status, response.text);
            alert('Komplain berhasil dikirim!');
            $('#complaintModal').modal('hide');
            document.getElementById('complaintForm').reset();
        }, function(error) {
            console.log('FAILED...', error);
            alert('Gagal mengirim komplain. Silakan coba lagi.');
        });
});
    </script>