@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="text-center mt-3" data-aos="fade-up">
                <span class="section-subtitle">INFORMASI TERKINI</span>
                <h2 class="section-title">Berita Sekolah</h2>
                <p>
                    Informasi dan berita terbaru seputar kegiatan sekolah.
                </p>
            </div>

            <div class="row g-4 mt-3">
                @forelse ($berita as $beritas)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <a href="{{ route('berita.detail', $beritas->slug) }}">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                                <div class="activity-image">
                                    <img src="{{ $beritas->gambar ? asset('storage/' . $beritas->gambar) : asset('assets/img/default-user.jpg') }}"
                                        alt="{{ $beritas->judul }}">
                                </div>

                                <div class="card-body p-4">
                                    <h5 class="fw-bold">{{ $beritas->judul }}</h5>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-calendar-event me-2"></i>{{ $beritas->tanggal->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Belum ada data guru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
