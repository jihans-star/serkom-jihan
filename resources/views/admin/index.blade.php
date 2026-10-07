@extends('layouts.admin')
@section('content')
    <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>
                        <strong>Berhasil!</strong>
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="page-heading mb-4">
                <div class="page-heading-copy d-flex align-items-center gap-3">
                    <div class="page-icon bg-primary-subtle text-primary p-3 rounded-4 shadow-sm d-flex align-items-center justify-content-center"
                        style="width:56px;height:56px;">
                        <i class="bi bi-grid-1x2-fill fs-4"></i>
                    </div>
                    <div>

                        @php
                            $hour = now()->hour;

                            if ($hour < 11) {
                                $greeting = 'Selamat Pagi';
                            } elseif ($hour < 15) {
                                $greeting = 'Selamat Siang';
                            } elseif ($hour < 18) {
                                $greeting = 'Selamat Sore';
                            } else {
                                $greeting = 'Selamat Malam';
                            }
                        @endphp

                        <p class="eyebrow text-uppercase fw-semibold text-muted mb-1 small">

                            {{ $greeting }},

                            <span class="text-primary fw-bold">
                                {{ auth()->user()->name ?? 'Guest' }}
                            </span>

                            <i class="fa-solid fa-hand wave-icon text-warning ms-1"></i>

                        </p>

                        <h1 class="h3 fw-bold mb-1">
                            Dashboard Utama
                        </h1>

                        <p class="text-muted mb-0 fs-6">
                            Pusat informasi dan pengelolaan website sekolah dengan mudah dan cepat.
                        </p>

                    </div>

                </div>

                <div class="heading-actions">

                    <span class="text-muted small">

                        <i class="bi bi-calendar3 me-1"></i>

                        {{ now()->translatedFormat('d F Y') }}

                    </span>

                </div>

            </div>


            <section class="row g-3">

                <div class="col-12 col-sm-6 col-xl-3">

                    <article class="metric-card metric-primary">

                        <div class="metric-top">

                            <span class="metric-label">
                                Total Siswa
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-mortarboard-fill"></i>
                            </span>

                        </div>

                        <div class="metric-value">
                            {{ $totalSiswa }}
                        </div>

                        <div class="metric-meta">

                            <span>
                                <i class="bi bi-database me-1"></i>
                                Data siswa
                            </span>

                        </div>

                    </article>

                </div>


                <div class="col-12 col-sm-6 col-xl-3">

                    <article class="metric-card metric-success">

                        <div class="metric-top">

                            <span class="metric-label">
                                Total Guru
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-person-workspace"></i>
                            </span>

                        </div>

                        <div class="metric-value">
                            {{ $totalGuru }}
                        </div>

                        <div class="metric-meta">

                            <span>
                                <i class="bi bi-person-check me-1"></i>
                                Tenaga pendidik
                            </span>

                        </div>

                    </article>

                </div>


                <div class="col-12 col-sm-6 col-xl-3">

                    <article class="metric-card metric-warning">

                        <div class="metric-top">

                            <span class="metric-label">
                                Total Berita
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-newspaper"></i>
                            </span>

                        </div>

                        <div class="metric-value">
                            {{ $totalBerita }}
                        </div>

                        <div class="metric-meta">

                            <span>
                                <i class="bi bi-megaphone me-1"></i>
                                Informasi sekolah
                            </span>

                        </div>

                    </article>

                </div>


                <div class="col-12 col-sm-6 col-xl-3">

                    <article class="metric-card metric-danger">

                        <div class="metric-top">

                            <span class="metric-label">
                                Total Prestasi
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-trophy-fill"></i>
                            </span>

                        </div>

                        <div class="metric-value">
                            {{ $totalPrestasi }}
                        </div>

                        <div class="metric-meta">

                            <span>
                                <i class="bi bi-award me-1"></i>
                                Prestasi sekolah
                            </span>

                        </div>

                    </article>

                </div>

            </section>


            <section class="row g-3 mt-1">

                <div class="col-12 col-sm-6 col-lg-3">

                    <article class="metric-card metric-primary">

                        <div class="metric-top">

                            <span class="metric-label">
                                Ekstrakurikuler
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-people-fill"></i>
                            </span>

                        </div>

                        <div class="metric-value">
                            {{ $totalEkskul }}
                        </div>

                        <div class="metric-meta">
                            <span>Kegiatan sekolah</span>
                        </div>

                    </article>

                </div>


                <div class="col-12 col-sm-6 col-lg-3">

                    <article class="metric-card metric-success">

                        <div class="metric-top">

                            <span class="metric-label">
                                Galeri
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-images"></i>
                            </span>

                        </div>

                        <div class="metric-value">
                            {{ $totalGaleri }}
                        </div>

                        <div class="metric-meta">
                            <span>Dokumentasi sekolah</span>
                        </div>

                    </article>

                </div>


                <div class="col-12 col-sm-6 col-lg-3">

                    <article class="metric-card metric-warning">

                        <div class="metric-top">

                            <span class="metric-label">
                                Pengguna
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-people-fill"></i>
                            </span>

                        </div>

                        <div class="metric-value">
                            {{ $totalUser }}
                        </div>

                        <div class="metric-meta">
                            <span>Akun sistem</span>
                        </div>

                    </article>

                </div>


                <div class="col-12 col-sm-6 col-lg-3">

                    <article class="metric-card metric-danger">

                        <div class="metric-top">

                            <span class="metric-label">
                                Total Data
                            </span>

                            <span class="metric-icon">
                                <i class="bi bi-database-fill"></i>
                            </span>

                        </div>

                        <div class="metric-value">

                            {{ $totalSiswa + $totalGuru + $totalBerita + $totalEkskul + $totalPrestasi + $totalGaleri + $totalUser }}

                        </div>

                        <div class="metric-meta">
                            <span>Seluruh data sistem</span>
                        </div>

                    </article>

                </div>

            </section>


            <section class="row g-3 mt-1">

                <div class="col-12 col-xl-8">

                    <div class="panel h-100">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1 section-title">

                                    <i class="bi bi-bar-chart-fill"></i>

                                    <span>
                                        Statistik Data Sekolah
                                    </span>

                                </h2>

                                <p class="text-muted mb-0">
                                    Perbandingan jumlah data yang tersimpan dalam sistem.
                                </p>

                            </div>

                        </div>

                        <div class="p-3">

                            <div style="height:320px;">

                                <canvas id="schoolDataChart" data-siswa="{{ $totalSiswa }}"
                                    data-guru="{{ $totalGuru }}" data-berita="{{ $totalBerita }}"
                                    data-ekskul="{{ $totalEkskul }}" data-prestasi="{{ $totalPrestasi }}"
                                    data-galeri="{{ $totalGaleri }}" data-user="{{ $totalUser }}">
                                </canvas>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-12 col-xl-4">

                    <div class="panel h-100">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1 section-title">

                                    <i class="bi bi-pie-chart-fill"></i>

                                    <span>
                                        Ringkasan Data
                                    </span>

                                </h2>

                                <p class="text-muted mb-0">
                                    Data utama sekolah.
                                </p>

                            </div>

                        </div>


                        <div class="p-3">

                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <span class="rounded-circle bg-primary-subtle p-2">
                                        <i class="bi bi-mortarboard-fill text-primary"></i>
                                    </span>

                                    <span>Siswa</span>

                                </div>

                                <strong>
                                    {{ $totalSiswa }}
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <span class="rounded-circle bg-success-subtle p-2">
                                        <i class="bi bi-person-workspace text-success"></i>
                                    </span>

                                    <span>Guru</span>

                                </div>

                                <strong>
                                    {{ $totalGuru }}
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <span class="rounded-circle bg-warning-subtle p-2">
                                        <i class="bi bi-newspaper text-warning"></i>
                                    </span>

                                    <span>Berita</span>

                                </div>

                                <strong>
                                    {{ $totalBerita }}
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <span class="rounded-circle bg-danger-subtle p-2">
                                        <i class="bi bi-trophy-fill text-danger"></i>
                                    </span>

                                    <span>Prestasi</span>

                                </div>

                                <strong>
                                    {{ $totalPrestasi }}
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <span class="rounded-circle bg-info-subtle p-2">
                                        <i class="bi bi-people-fill text-info"></i>
                                    </span>

                                    <span>Ekskul</span>

                                </div>

                                <strong>
                                    {{ $totalEkskul }}
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between align-items-center mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <span class="rounded-circle bg-secondary-subtle p-2">
                                        <i class="bi bi-images text-secondary"></i>
                                    </span>

                                    <span>Galeri</span>

                                </div>

                                <strong>
                                    {{ $totalGaleri }}
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between align-items-center">

                                <div class="d-flex align-items-center gap-2">

                                    <span class="rounded-circle bg-primary-subtle p-2">
                                        <i class="bi bi-people text-primary"></i>
                                    </span>

                                    <span>Pengguna</span>

                                </div>

                                <strong>
                                    {{ $totalUser }}
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <section class="row g-3 mt-1">

                <div class="col-12 col-xl-7">

                    <div class="panel h-100">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1 section-title">

                                    <i class="bi bi-clock-history"></i>

                                    <span>
                                        Data Terbaru
                                    </span>

                                </h2>

                                <p class="text-muted mb-0">
                                    Data yang baru ditambahkan ke dalam sistem.
                                </p>

                            </div>

                        </div>


                        <div class="p-3">

                            @forelse ($dataTerbaru as $data)
                                <div class="d-flex align-items-center gap-3 border-bottom pb-3 mb-3">

                                    <div class="rounded-3 bg-{{ $data['warna'] }}-subtle text-{{ $data['warna'] }} d-flex align-items-center justify-content-center"
                                        style="width:50px;height:50px;flex-shrink:0;">

                                        <i class="bi {{ $data['icon'] }} fs-5"></i>

                                    </div>


                                    <div class="flex-grow-1">

                                        <h6 class="mb-1 fw-semibold">

                                            {{ $data['nama'] }}

                                        </h6>

                                        <small class="text-muted">

                                            <span class="fw-medium text-dark">{{ $data['detail'] }}</span>
                                            •
                                            {{ $data['jenis'] }}

                                            @if ($data['tanggal'])
                                                •
                                                {{ $data['tanggal']->translatedFormat('d F Y, H:i') }}
                                            @endif

                                        </small>

                                    </div>

                                </div>

                            @empty

                                <div class="text-center text-muted py-5">

                                    <i class="bi bi-database fs-1 d-block mb-2"></i>

                                    Belum ada data terbaru.

                                </div>
                            @endforelse

                        </div>

                    </div>

                </div>


                <div class="col-12 col-xl-5">

                    <div class="panel h-100">

                        <div class="panel-header">

                            <div>

                                <h2 class="h5 mb-1 section-title">

                                    <i class="bi bi-info-circle-fill"></i>

                                    <span>
                                        Informasi Dashboard
                                    </span>

                                </h2>

                                <p class="text-muted mb-0">
                                    Ringkasan pengelolaan website sekolah.
                                </p>

                            </div>

                        </div>


                        <div class="p-3">

                            <div class="d-flex gap-3 mb-4">

                                <span class="metric-icon">

                                    <i class="bi bi-mortarboard-fill"></i>

                                </span>

                                <div>

                                    <h6 class="mb-1">
                                        Sistem Informasi Sekolah
                                    </h6>

                                    <p class="text-muted small mb-0">

                                        Kelola data siswa, guru, berita,
                                        ekstrakurikuler, prestasi, dan galeri
                                        melalui dashboard administrator.

                                    </p>

                                </div>

                            </div>


                            <div class="d-flex justify-content-between align-items-center py-2 border-top">

                                <span class="text-muted">

                                    <i class="bi bi-database me-2"></i>

                                    Total seluruh data

                                </span>

                                <strong>

                                    {{ $totalSiswa + $totalGuru + $totalBerita + $totalEkskul + $totalPrestasi + $totalGaleri + $totalUser }}

                                </strong>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>
@endsection
