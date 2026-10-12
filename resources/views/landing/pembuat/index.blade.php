@extends('layouts.landing')
@section('content')
    <section class="py-5 mt-5">
        <div class="container py-4">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Profil</span>
                <h2 class="section-title">
                    Pembuat Website
                </h2>
                <p style="max-width: 70%" class="m-auto">
                    Bio Data Pembuat Website SMA Nova Cendekia
                </p>
            </div>

            <div class="row align-items-center g-4">
                <div class="col-lg-4 text-center" data-aos="fade-right">
                    <div class="card border-0 shadow-lg p-4" style="height: 320px">
                        <div class="mb-3">
                            <img src="{{ asset('assets/images/jihan-latar-merah.png') }}"
                                alt="{{ $profil->kepala_sekolah ?? 'Kepala Sekolah' }}"
                                class="rounded-circle object-fit-cover shadow-sm mx-auto"
                                style="width: 165px; height: 200px;">
                        </div>
                        <h5 class="fw-bold mb-1">Jihan Safitri</h5>
                        <p class="text-muted small mb-0">Siswi SMK YPC Tasikmalaya</p>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="card border-0 shadow-lg p-4 h-100">
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="text-muted small">NISN</div>
                                <div class="fw-semibold text-dark">0089238502</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted small">Tempat, Tanggal Lahir</div>
                                <div class="fw-semibold text-dark">Tasikmalaya, 01 Oktober 2008</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted small">Kelas</div>
                                <div class="fw-semibold text-dark">
                                    <span class="badge bg-success bg-opacity-15 text-white px-2 py-1">
                                        XII
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted small">Jurusan</div>
                                <div class="fw-semibold text-dark">Rekayasa Perangkat Lunak (RPL)</div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted small">Alamat Lengkap</div>
                                <div class="fw-semibold text-dark">Jawa Barat, Tasikmalaya</div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-25 my-1">

                        <div class="mt-1">
                            <p class="text-dark mb-0" style="white-space: pre-line; font-size: 0.95rem;">
                                Memiliki cita-cita menjadi programer dan mempermudah masyarakat mendapat informasi secara digital
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
