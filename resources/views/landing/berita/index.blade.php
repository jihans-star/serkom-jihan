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

            <div class="row border-top" data-aos="fade-up">
                <div class="col-md-4 ms-auto mt-3" data-aos="fade-up">
                    <form action="{{ route('berita') }}" method="GET" class="mb-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                            placeholder="Cari judul berita..."
                            value="{{ $_GET['search'] ?? '' }}">

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row g-4 mt-3">
                @forelse ($berita as $beritas)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <a href="{{ route('berita.detail', $beritas->slug) }}" >
                            <div class="activity-card">
                                <div class="activity-image">
                                    <img src="{{ $beritas->gambar ? asset('storage/' . $beritas->gambar) : asset('assets/img/default-user.jpg') }}"
                                        alt="{{ $beritas->judul }}">
                                </div>

                                <div class="card-body p-4">
                                    <h6 class="fw-bold text-dark">{{ $beritas->judul }}</h6>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-calendar-event me-2"></i>{{ $beritas->tanggal->format('d M, Y') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Belum ada data berita.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
