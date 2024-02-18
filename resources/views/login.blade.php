<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISTEM PRAKERIN SMKN 1 ADIWERNA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/welcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

    {{-- navigation bar --}}
    <nav class="navbar fixed-top justify-content-between navbar-expand-lg">
        <a href="/" style="text-decoration: none;">
            <button type="button" class="d-flex btn btn-outline-light"><i
                    class="fa-solid fa-chevron-left"></i></button>
        </a>
    </nav>

    <style>
        .bg-main {
            background-image: url("/assets/img/Bglogin.jpg");
            height: 100vh;
            background-repeat: no-repeat, repeat;
            background-size: cover;
        }

        .main {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            font-family: Poppins;
            font-size: 15px;
        }

        .w-60 {
            background-color: white;
        }

        .alert {
            font-family: Poppins;
            font-size: 15px;
            margin-bottom: 0%;
        }

        .custom-button {
            background-color: #2A356C;
            color: #FFFFFF;
        }

        .btn-outline-secondary {
            --bs-btn-border-color: white;
            --bs-btn-hover-border-color: white;
            --bs-btn-active-border-color: white;
            border-left: 2px;
            --bs-btn-color: #2A356C;
            --bs-btn-hover-bg: #2A356C;
            --bs-btn-active-bg: #2A356C;
            --bs-btn-disabled-color: #2A356C;
            --bs-btn-disabled-border-color: #2A356C;

        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");
            const passwordToggle = document.getElementById("password-toggle");
            const eyeicon = document.getElementById("eye-icon");

            passwordToggle.addEventListener("click", function() {
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    eyeicon.classList.remove("fa-eye-slash");
                    eyeicon.classList.add("fa-eye");
                } else {
                    passwordInput.type = "password";
                    eyeicon.classList.remove("fa-eye");
                    eyeicon.classList.add("fa-eye-slash");
                }
            });
        });
    </script>

    <div class="bg-main">
        <div class="main">
            <div class="container py-5">
                <div class="w-60 center border rounded px-3 py-3 mx-auto" style="width: 50%;">
                    <div class="login-head-logo py-3 text-center">
                        <div style="margin-bottom: -3%;">
                            <img src="assets/img/logosmk.png" alt="logo" width="70" height="70">
                        </div>
                        <br>
                        <a style="font-weight: bold; font-size: 18px;">Sistem Informasi Prakerin SMKN 1 Adiwerna</a>
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="login_number" class="col-md-4 col-form-label text-md-end">NIS/NIP</label>
                            <div class="col-md-6">
                                <input type="text" value="{{ old('login_number') }}" name="login_number"
                                    class="form-control" style="font-size: 15px;">
                                @error('login_number')
                                    <div style="color: red; font-size: 12px">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="password"
                                        style="font-size: 15px;">
                                    <div class="input-group-append">
                                        <button type="button" id="password-toggle" class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-eye-slash" id="eye-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password')
                                    <div style="color: red; font-size: 12px">{{ $message }}</div>
                                @enderror
                                @if ($errors->has('login'))
                                    <div style="color: red; font-size: 12px">{{ $errors->first('login') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                            <button name="submit" type="submit" class="btn custom-button"
                                style="width: 200px; font-size: 15px;">Login</button>
                        </div>
                    </form>
                    {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // ... (kode yang sudah ada)
    
            // Fungsi untuk mereset notificationStatus ke "open" pada localStorage
            function resetNotificationStatus() {
                localStorage.setItem("notificationStatus", "open");
            }
    
            // Event listener untuk menambahkan fungsi resetNotificationStatus saat tombol login ditekan
            $(document).ready(function () {
                $('#login-button').on('click', function () {
                    resetNotificationStatus();
                });
            });
        });
    </script>

</body>

</html>
