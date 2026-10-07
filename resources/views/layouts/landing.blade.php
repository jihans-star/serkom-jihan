@php
    $profilGlobal = \App\Models\Profil_sekolah::first();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a href="{{ route('landing') }}" class="navbar-brand">
                <span class="brand-icon">
                    @if ($profilGlobal && $profilGlobal->logo)
                        <img src="{{ asset('storage/' . $profilGlobal->logo) }}" alt="Logo Sekolah">
                    @else
                        <img src="{{ asset('images/default-logo.png') }}" alt="Logo Default">
                    @endif
                </span>
                <span class="brand-name">
                    {{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}
                </span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a href="{{ route('landing') }}"
                            class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profil') }}"
                            class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}">
                            Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('guru') }}"
                            class="nav-link {{ request()->routeIs('guru') ? 'active' : '' }}">
                            Guru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ekstrakurikuler') }}"
                            class="nav-link {{ request()->routeIs('ekstrakurikuler') ? 'active' : '' }}">
                            Ekstrakurikuler
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('prestasi') }}"
                            class="nav-link {{ request()->routeIs('prestasi') ? 'active' : '' }}">
                            Prestasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('galeri') }}"
                            class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}">
                            Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('berita') }}"
                            class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}">
                            Berita
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h4>{{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}</h4>
                    <p>
                        {{ $profil->deskripsi ?? 'Membangun generasi unggul, berkarakter, dan berprestasi melalui pendidikan berkualitas.' }}
                    </p>

                    <div class="social-links">
                        <a href="#">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3">
                    <h5>Menu</h5>
                    <ul class="footer-menu">
                        <li>
                            <a href="{{ route('landing') }}">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('profil') }}">Profil</a>
                        </li>
                        <li>
                            <a href="{{ route('guru') }}">Guru</a>
                        </li>
                        <li>
                            <a href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
                        </li>
                        <li>
                            <a href="{{ route('prestasi') }}">Prestasi</a>
                        </li>
                        <li>
                            <a href="{{ route('galeri') }}">Galeri</a>
                        </li>
                        <li>
                            <a href="{{ route('berita') }}">Berita</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4">
                    <h5>Kontak</h5>

                    <ul class="contact-list">
                        <li>
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>{{ $profil->alamat ?? '-' }}</span>
                        </li>

                        <li>
                            <i class="bi bi-telephone-fill"></i>
                            <span>{{ $profil->kontak ?? '-' }}</span>
                        </li>

                        <li>
                            <i class="bi bi-envelope-fill"></i>
                            <span>smanovacendekia@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>
                    © {{ date('Y') }}
                    {{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}.
                    All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/slider.js') }}"></script>

    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>

    @stack('scripts')
</body>

</html>
