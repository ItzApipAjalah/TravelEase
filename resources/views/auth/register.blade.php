<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>TravelEease | Register</title>

    <style>
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: 300px;
        }
    </style>
</head>

<body>

    <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #366389;">
                <div class="featured-image mb-3">
                    <img src="{{ asset('assets/img/homepage&history.png') }}" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">
                    Daftar Sekarang!</p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Jadikan Bepergian Lebih
                    Mudah.</small>
            </div>

            <!--------------------------- Right Box ----------------------------->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Buat Akun</h2>
                        <p>Kami senang memiliki Pengguna baru.</p>
                    </div>

                    <form action="{{ route('register.save') }}" method="POST">
                        @csrf
                        <div class="input-group mb-1">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Name"
                                name="name" required="">

                        </div>

                        <div class="input-group mb-1">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Email address" name="email" required="">
                                
                        </div>

                        <div class="input-group mb-1">
                        <input id="password" type="password" class="form-control form-control-lg bg-light fs-6"
                            placeholder="Password" name="password" required="">
                        <span class="input-group-text" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')">
                            <i class="fa fa-eye" id="togglePasswordIcon"></i>
                        </span>
                    </div>

                    <div class="input-group mb-1">
                        <input id="password_confirmation" type="password"
                            class="form-control form-control-lg bg-light fs-6" placeholder="Password Confirmation"
                            name="password_confirmation" required="">
                        <span class="input-group-text" onclick="togglePasswordVisibility('password_confirmation', 'toggleConfirmPasswordIcon')">
                            <i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
                        </span>
                    </div>

                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6" type="submit">Login</button>
                        </div>
                    </form>



                    <div class="row">
                        <small>Have an account? <a href="{{ route('login') }}">Sign IN</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Alert Container -->
    <div class="alert-container">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2JkjCuxq1g5J7zQ2d+4X+zV+nD32nsN5m8w8hXjQlb43Dk5CNh8zxK3QZdx" crossorigin="anonymous">
    </script>

    <script>
        // Auto-hide alert after 5 seconds
        setTimeout(function() {
            let alertElement = document.querySelector('.alert');
            if (alertElement) {
                let alert = new bootstrap.Alert(alertElement);
                alert.close();
            }
        }, 5000); // Hide after 5 seconds

        function togglePasswordVisibility(inputId, iconId) {
        const passwordField = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
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