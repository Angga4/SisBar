<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Peminjaman Barang Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1e40af;
            --accent-color: #60a5fa;
            --bg-color: #f0f9ff;
        }
        
        body {
            background-color: var(--bg-color);
            background-image: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .login-card:hover {
            box-shadow: 0 12px 40px rgba(31, 38, 135, 0.15);
            transform: translateY(-5px);
        }
        
        .login-header {
            text-align: center;
            padding: 30px 20px 0;
            color: var(--secondary-color);
        }
        
        .login-header h1 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .login-header p {
            color: #6b7280;
            font-size: 0.95rem;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .login-illustration {
            background-color: var(--primary-color);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            text-align: center;
            min-height: 100%;
        }
        
        .login-illustration svg {
            max-width: 250px;
            margin-bottom: 20px;
        }
        
        .login-illustration h2 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .login-illustration p {
            font-size: 0.95rem;
            opacity: 0.9;
        }
        
        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #e5e7eb;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            background-color: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
            border-color: var(--primary-color);
        }
        
        .form-floating>label {
            padding: 12px 15px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .input-group-text {
            background-color: transparent;
            border-left: none;
            cursor: pointer;
        }
        
        .password-toggle {
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
        }
        
        .login-footer {
            text-align: center;
            padding: 0 30px 30px;
            color: #6b7280;
            font-size: 0.9rem;
        }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050; /* Pastikan notifikasi berada di atas elemen lain */
        }
        
        @media (max-width: 767.98px) {
            .login-illustration {
                padding: 40px 20px;
                border-radius: 16px 16px 0 0;
            }
        }
    </style>
</head>
<body>
@if(session('error') || session('success'))
        <div class="notification">
            <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" role="alert">
                {{ session('success') ?: session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="login-container">
        <div class="row g-0 login-card">
            <div class="col-md-6 d-none d-md-block">
                <div class="login-illustration">
                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 400 300">
                        <path fill="#fff" fill-opacity="0.2" d="M271.52 119.65s-24.76-25.64-40.52-25.77-41.85 23.2-41.85 23.2-39.29-7.79-51.26 9.33-5.32 31.64-5.32 31.64-38.15 12-36.87 36.31 27.78 27.25 27.78 27.25 28.25 32.38 59.49 32.51 43.1-21.8 43.1-21.8 42.33 11.07 56.17-13 2.93-37.46 2.93-37.46 32.11-24.76 16.87-48.56-30.52-13.65-30.52-13.65Z" />
                        <path fill="#60a5fa" d="M121.93 143.71h150.06v69.44a8.8 8.8 0 0 1-8.8 8.8H130.73a8.8 8.8 0 0 1-8.8-8.8v-69.44Z" />
                        <path fill="#3b82f6" d="M121.93 130.29h150.06v13.42H121.93z" />
                        <path fill="#fff" fill-opacity="0.4" d="M139.62 156.18h31.4v36.54h-31.4zM226.94 156.18h31.4v36.54h-31.4z" />
                        <path fill="#fff" fill-opacity="0.4" d="M180.73 156.18h31.4v36.54h-31.4z" />
                        <path fill="#2563eb" d="M259.43 134.38a2.05 2.05 0 1 0 2.05 2.05 2.05 2.05 0 0 0-2.05-2.05ZM245.46 134.38a2.05 2.05 0 1 0 2.06 2.05 2.05 2.05 0 0 0-2.06-2.05ZM231.49 134.38a2.05 2.05 0 1 0 2.06 2.05 2.05 2.05 0 0 0-2.06-2.05Z" />
                        <path fill="#1e40af" d="m200.21,102.46c-16.25,0.14-41.85,23.2-41.85,23.2-7.19-1.43-14.3-1.83-20.85-0.72v5.36h87.75v-27.25c-7.92-0.6-16.23-0.73-25.05-0.59Z" />
                        <path fill="#1e40af" d="M271.52,119.65s-17.78-18.42-32.29-24.21v35.28h57.88c-3.16-6.69-10.6-11.27-25.59-11.07Z" />
                        <path fill="#1e40af" d="M123.83,155.18c-2.78,0.87-5.46,1.95-7.9,3.3v54.66c0,4.86,3.94,8.8,8.8,8.8h13.28v-66.54c-4.75-0.83-9.43-0.88-14.18-0.22Z" />
                        <rect fill="#fff" fill-opacity="0.4" x="171.96" y="204.53" width="20" height="17.42" rx="2" ry="2" />
                        <path fill="#fff" d="M188.5 213.23a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0ZM175.44 213.23a1.5 1.5 0 1 0 3 0 1.5 1.5 0 0 0-3 0ZM181.96 213.23a1.5 1.5 0 1 0 3 0 1.5 1.5 0 0 0-3 0Z" />
                    </svg>
                    <h2>Sistem Peminjaman Barang</h2>
                    <p>Kelola inventaris dan peminjaman barang sekolah dengan mudah, cepat, dan efisien.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-header">
                    <h1>Selamat Datang</h1>
                    <p>Silakan masuk untuk melanjutkan</p>
                </div>
                <div class="login-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="email" class="form-control" id="emali" name="email" placeholder="email" required>
                            <label for="email"><i class="fas fa-user me-2"></i> Email</label>
                            @error('email')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password"><i class="fas fa-lock me-2"></i> Password</label>
                            <button type="submit" class="password-toggle position-absolute end-0 top-50 translate-middle-y me-3" onclick="togglePassword()">
                                <i class="far fa-eye" id="toggleIcon"></i>
                            </button>
                            @error('password')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                            
                            </div>                            
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-2"></i> Masuk
                        </button>
                    </form>
                </div>
                <div class="login-footer">
                    <p>&copy; {{ date('Y') }} Sistem Manajemen Peminjaman Barang Sekolah</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.remove();
                }, 5000); // Hapus notifikasi setelah 5 detik
            });
        });
    </script>
</body>
</html>
