<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    <title>Login | Panel Sekolah</title>
</head>

<body>

    @php
        $profil = \App\Models\Profil_sekolah::first();
    @endphp

    <div class="login-wrapper">

        <div class="login-image">

            @if ($profil && $profil->foto)
                <img
                    src="{{ asset('storage/' . $profil->foto) }}"
                    alt="Foto Sekolah"
                    class="login-bg">
            @else
                <div class="login-bg-default"></div>
            @endif

            <div class="image-overlay"></div>

            <div class="image-content">

                <span class="badge-login">
                    SCHOOL MANAGEMENT SYSTEM
                </span>

                <h1>
                    Selamat Datang<br>
                    di Panel Sekolah
                </h1>

                <p>
                    Kelola informasi dan administrasi sekolah
                    dengan mudah melalui panel administrator.
                </p>

            </div>

        </div>

        <div class="login-content">

            <div class="login-box">

                <div class="logo">
                    <i class="icon-lock"></i>
                </div>

                <h2>Selamat Datang!</h2>

                <p class="subtitle">
                    Silakan login untuk mengakses panel sekolah.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.show') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="username">
                            Username
                        </label>

                        <div class="input-box">
                            <i class="icon-user"></i>

                            <input
                                type="text"
                                name="username"
                                id="username"
                                class="form-control"
                                placeholder="Masukkan username"
                                value="{{ old('username') }}"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">
                            Password
                        </label>

                        <div class="input-box">
                            <i class="icon-lock"></i>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="icon-sign-in mr-2"></i>
                        Login
                    </button>

                </form>

                <div class="footer-text">
                    © {{ date('Y') }} {{ $profil->nama_sekolah ?? 'SMA Nova Cendikia' }}
                </div>

            </div>

        </div>

    </div>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</body>

</html>
