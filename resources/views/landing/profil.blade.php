@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="text-center mt-3" data-aos="fade-up">
                <span class="section-subtitle">PROFIL SEKOLAH</span>
                <h2 class="section-title">
                    {{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}
                </h2>

                <p class="profile-description">
                    {{ $profil->deskripsi ?? 'SMA Nova Cendekia merupakan sekolah yang berkomitmen memberikan pendidikan berkualitas bagi seluruh peserta didik.' }}
                </p>
            </div>

            <div class="row align-items-center g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="principal-card">
                        <img src="{{ $profil->foto_kepala_sekolah ? asset('storage/' . $profil->foto_kepala_sekolah) : asset('assets/img/default-user.jpg') }}"
                            alt="{{ $profil->kepala_sekolah ?? 'Kepala Sekolah' }}">

                        <div class="principal-info">
                            <span class="section-subtitle">KEPALA SEKOLAH</span>
                            <h3>{{ $profil->kepala_sekolah ?? '-' }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-7" data-aos="fade-left">
                    <div class="school-detail">

                        <div class="profile-info">
                            <div class="info-item">
                                <i class="bi bi-calendar-event"></i>
                                <div>
                                    <small>Tahun Berdiri</small>
                                    <h5>{{ $profil->tahun_berdiri ?? '-' }}</h5>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-building"></i>
                                <div>
                                    <small>NPSN</small>
                                    <h5>{{ $profil->npsp ?? '-' }}</h5>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-telephone"></i>
                                <div>
                                    <small>Kontak</small>
                                    <h5>{{ $profil->kontak ?? '-' }}</h5>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div>
                                    <small>Alamat</small>
                                    <h5>{{ $profil->alamat ?? '-' }}</h5>
                                </div>
                            </div>

                        </div>

                        <div class="profile-info1">
                            <div class="info-item mt-3">
                                <i class="bi bi-bullseye"></i>
                                <div>
                                    <small>Visi & Misi</small>
                                    <h5>{{ $profil->visi_misi ?? '-' }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
