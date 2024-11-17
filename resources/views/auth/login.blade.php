<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>LOGIN Admin KAI</title>
    <link href="assets/img/kai.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
    .login-card {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 40px;
    }

    .form-group label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
    }

    .input-group-text {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        cursor: pointer;
    }
    .login-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
    padding-bottom: 15px;
}

.login-title::after {
    content: '';
    position: absolute;
    left: 50%;
    bottom: 0;
    transform: translateX(-50%);
    height: 4px;
    width: 50px;
    background-color: #007bff; /* Sesuaikan dengan warna tema Anda */
    border-radius: 2px;
}

.login-title::before {
    content: '👤'; /* Emoji atau ikon lain yang sesuai */
    font-size: 1.5rem;
    margin-right: 10px;
    vertical-align: middle;
}
</style>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand text-center">
                        <img src="assets/img/kai.png" width="130px" height="100px" alt="logo">
                    </div>
                    <div class="card fat login-card">
                        <div class="card-body">
                        <h4 class="card-title text-center login-title">Login</h4>
                            @if ($errors->any('NIPP'))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $item)
                                            <li>{{$item}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">NIPP</label>
                                    <input id="NIPP" type="NIPP" value="{{ old('NIPP') }}" name="NIPP" class="form-control"  placeholder="Masukkan NIPP Anda">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input id="password" type="password" value="{{ old('password') }}" name="password" class="form-control" placeholder="Masukkan password Anda">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword()">
                                                <i class="fas fa-eye" id="toggleEye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer text-center">
                        Copyright &copy; 2024 &mdash; KAI DAOP 7 Sistem Informasi
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleEye = document.getElementById("toggleEye");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleEye.classList.remove("fa-eye");
                toggleEye.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleEye.classList.remove("fa-eye-slash");
                toggleEye.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
