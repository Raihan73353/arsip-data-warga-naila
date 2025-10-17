<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login - ANTREANKU</title>

    <!-- Font & Icon -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Base Style -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1d2671, #c33764);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .login-header h1 {
            font-weight: 600;
            color: #fff;
        }

        .login-header p {
            color: rgba(255, 255, 255, 0.85);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 30px;
            padding: 0.75rem 1.25rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(29, 38, 113, 0.2);
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 30px;
            color: #fff;
            font-weight: 500;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
            transform: scale(1.02);
        }

        .alert {
            border-radius: 20px;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-top: 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-lg-5 mx-auto">
            <div class="card login-card p-4">
                <div class="login-header text-center mb-4">
                    <h1>Selamat Datang</h1>
                    <p>Dinas Kependudukan & Pencatatan Sipil<br>Kabupaten Aceh Tamiang</p>
                </div>

                @if(session()->has('loginError'))
                    <div class="alert alert-danger">
                        {{ session('loginError') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="user">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" name="username"
                               class="form-control"
                               placeholder="Masukkan Username" required autofocus>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" name="password"
                               class="form-control"
                               placeholder="Masukkan Password" required>
                    </div>
                    <button type="submit" class="btn btn-login btn-block">Masuk</button>
                </form>
            </div>

            <div class="footer-text">
                © {{ date('Y') }} ANTREANKU | Dinas Dukcapil Aceh Tamiang
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
