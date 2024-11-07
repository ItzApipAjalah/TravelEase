<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>TravelEase | Login</title>
</head>
<body>

    <!-- Main Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- Login Container -->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!-- Left Box -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #366389;">
                <div class="featured-image mb-3">
                    <img src="{{ asset('assets/img/homepage&history.png') }}" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">TravelEease</p>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Jadikan Bepergian Lebih Mudah.</small>
            </div> 

            <!-- Right Box -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">

                    <!-- Back arrow -->
                    <div class="col-12 mb-4">
                        <a href="{{ route('landing.page') }}" class="text-dark">
                            <i class="bi bi-arrow-left fs-4"></i> <!-- Icon Bootstrap -->
                        </a>
                    </div>

                    <!-- Tampilkan Notifikasi Sukses Login -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Tampilkan Error (Jika Akun Belum Disetujui) -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Header Text -->
                    <div class="header-text mb-4">
                        <h2>Haii Selamat Datang</h2>
                        <p>Kami senang anda kembali.</p>
                    </div>

                    <!-- Login Form -->
                    <form action="{{ route('login.action') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="email">
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" id="password">
                            <span class="input-group-text" onclick="togglePasswordVisibility()">
                                <i class="fa fa-eye" id="togglePasswordIcon"></i>
                            </span>
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck" name="remember">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                            </div>
                            {{-- <div class="forgot">
                                <small><a href="{{ route('password.email') }}">Forgot Password?</a></small>
                            </div> --}}
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>

                   

                    <!-- Sign Up Link -->
                    <div class="row">
                        <small>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></small>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
        const passwordField = document.getElementById("password");
        const icon = document.getElementById("togglePasswordIcon");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    </script>
</body>
</html>