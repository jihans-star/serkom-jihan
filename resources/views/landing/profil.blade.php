@extends('layouts.landing')
@section('content')
    <section class="py-5 mt-5">
        <div class="container py-4">           
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Profil Sekolah</span>
                <h2 class="section-title">
                    {{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}
                </h2>
                <p style="max-width: 70%" class="m-auto">
                    {{ $profil->deskripsi ?? 'SMA Nova Cendekia merupakan sekolah yang berkomitmen memberikan pendidikan berkualitas bagi seluruh peserta didik.' }}
                </p>
            </div>

            <div class="row align-items-center g-4">                
                <div class="col-lg-4 text-center" data-aos="fade-right">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="mb-3">
                            <img src="{{ $profil && $profil->foto_kepala_sekolah ? asset('storage/' . $profil->foto_kepala_sekolah) : asset('assets/img/default-user.jpg') }}"
                                alt="{{ $profil->kepala_sekolah ?? 'Kepala Sekolah' }}"
                                class="rounded-circle object-fit-cover shadow-sm mx-auto"
                                style="width: 130px; height: 130px;">
                        </div>
                        <h5 class="fw-bold mb-1">{{ $profil->kepala_sekolah ?? 'Belum diatur' }}</h5>
                        <p class="text-muted small mb-0">Kepala Sekolah</p>
                    </div>
                </div>             
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <h5 class="fw-bold mb-3">Informasi Institusi</h5>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="text-muted small">NPSN</div>
                                <div class="fw-semibold text-dark">{{ $profil->npsp ?? '-' }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted small">Tahun Berdiri</div>
                                <div class="fw-semibold text-dark">{{ $profil->tahun_berdiri ?? '-' }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted small">Akreditasi</div>
                                <div class="fw-semibold text-dark">
                                    <span class="badge bg-success bg-opacity-15 text-white px-2 py-1">
                                        A
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted small">Kontak</div>
                                <div class="fw-semibold text-dark">{{ $profil->kontak ?? '-' }}</div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted small">Alamat Lengkap</div>
                                <div class="fw-semibold text-dark">{{ $profil->alamat ?? '-' }}</div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-25 my-1">

                        <div class="mt-1">                            
                            <p class="text-dark mb-0" style="white-space: pre-line; font-size: 0.95rem;">
                                {{ $profil->visi_misi ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection