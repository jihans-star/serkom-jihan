@php
    $profilGlobal = \App\Models\Profil_sekolah::first();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Manajemen Sekolah">
    <title>Sistem Informasi Cendekia</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="admin-shell">

        <div class="sidebar-backdrop" data-sidebar-close></div>

        <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
            <div class="sidebar-header">
                <a class="brand-mark" href="{{ route('admin.index') }}" aria-label="Dashboard">
                    <span class="brand-icon">
                        @if ($profilGlobal && $profilGlobal->logo)
                            <img src="{{ asset('storage/' . $profilGlobal->logo) }}" alt="Logo Sekolah">
                        @else
                            <img src="{{ asset('images/default-logo.png') }}" alt="Logo Default">
                        @endif
                    </span>
                    <span class="brand-copy">
                        <span class="brand-title">ADMINOVA</span>
                        <span class="brand-subtitle">SMA Nova Cendekia</span>
                    </span>
                </a>
            </div>

            <nav class="sidebar-nav">

                <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}"
                    href="{{ route('admin.index') }}">
                    <span class="nav-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>

                <a class="nav-link {{ request()->routeIs('admin.sekolah*') ? 'active' : '' }}"
                    href="{{ route('admin.sekolah.index') }}">
                    <span class="nav-icon"><i class="bi bi-building-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Profil Sekolah</span>
                </a>

                <a class="nav-link {{ request()->routeIs('admin.siswa*') ? 'active' : '' }}"
                    href="{{ route('admin.siswa.index') }}">
                    <span class="nav-icon"><i class="bi bi-mortarboard-fill" aria-hidden="true"></i></span>
                    <span class="nav-text">Data Siswa</span>
                </a>

                <a class="nav-link {{ request()->routeIs('admin.guru*') ? 'active' : '' }}"
                    href="{{ route('admin.guru.index') }}">
                    <span class="nav-icon"><i class="bi bi-person-workspace" aria-hidden="true"></i></span>
                    <span class="nav-text">Data Guru</span>
                </a>

                <a class="nav-link {{ request()->routeIs('admin.galeri*') ? 'active' : '' }}"
                    href="{{ route('admin.galeri.index') }}">
                    <span class="nav-icon"><i class="bi bi-images" aria-hidden="true"></i></span>
                    <span class="nav-text">Data Galeri</span>
                </a>


                <a class="nav-link {{ request()->routeIs('admin.berita*') ? 'active' : '' }}"
                    href="{{ route('admin.berita.index') }}">
                    <span class="nav-icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
                    <span class="nav-text">Data Berita</span>
                </a>

                <a class="nav-link {{ request()->routeIs('admin.ekstrakurikuler*') ? 'active' : '' }}"
                    href="{{ route('admin.ekstrakurikuler.index') }}">
                    <span class="nav-icon"><i class="bi bi-stars" aria-hidden="true"></i></span>
                    <span class="nav-text">Data Ekstrakurikuler</span>
                </a>

                <a class="nav-link {{ request()->routeIs('admin.prestasi*') ? 'active' : '' }}"
                    href="{{ route('admin.prestasi.index') }}">
                    <span class="nav-icon"><i class="bi bi-trophy" aria-hidden="true"></i></span>
                    <span class="nav-text">Data Prestasi</span>
                </a>

                @if (auth()->check() && auth()->user()->role === 'Admin')
                    <a class="nav-link {{ request()->routeIs('admin.user*') ? 'active' : '' }}"
                        href="{{ route('admin.user.index') }}">
                        <span class="nav-icon"><i class="bi bi-person-badge-fill" aria-hidden="true"></i></span>
                        <span class="nav-text">Data Pengelola</span>
                    </a>
                @endif


            </nav>

            <div class="sidebar-footer">
                <span class="status-dot"></span>
                <span class="sidebar-footer-text">Sistem berjalan normal</span>
            </div>

        </aside>

        <div class="admin-main">
            <nav class="navbar admin-navbar navbar-expand bg-white">
                <div class="container-fluid px-3 px-lg-4">

                    <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar"
                        aria-expanded="true" aria-label="Toggle sidebar">
                        <span></span><span></span><span></span>
                    </button>

                    <div class="navbar-actions ms-auto">
                        <button class="icon-button theme-toggle" type="button" data-theme-toggle
                            aria-label="Switch color theme" title="Ubah tema">
                            <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
                        </button>

                        <div class="dropdown">
                            <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span
                                    class="profile-avatar d-inline-flex align-items-center justify-content-center me-2 overflow-hidden"
                                    style="width:34px;height:34px;border-radius:50%;background:#f1f5f9;">
                                    @if (auth()->check() && !empty(auth()->user()->avatar))
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                            alt="{{ auth()->user()->name }}"
                                            style="width:100%;height:100%;object-fit:cover;">
                                    @else
                                        <i class="bi bi-person-fill"></i>
                                    @endif
                                </span>
                                <span class="profile-name d-none d-sm-inline">
                                    {{ auth()->check() ? auth()->user()->name : 'Guest' }}
                                </span>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <h6 class="dropdown-header">
                                        {{ auth()->check() ? 'Akun ' . auth()->user()->role : 'Akun Tamu' }}
                                    </h6>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        <i class="bi bi-person me-2"></i> Profil
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </nav>

            <main class="dashboard-content">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif --}}

                @yield('content')
            </main>
            <footer class="admin-footer">
                <div class="container-fluid px-3 px-lg-4">
                    <span>
                        © 2026 <strong>ADMINOVA</strong>
                        <br>
                        Sistem Informasi Manajemen SMA Nova Cendekia
                    </span>
                    <span>
                        <i class="bi bi-shield-check me-1"></i> Admin Panel
                    </span>
                </div>
            </footer>

        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
