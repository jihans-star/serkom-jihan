@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="text-center mt-3" data-aos="fade-up">
                <span class="section-subtitle">PENCAPAIAN SEKOLAH</span>
                <h2 class="section-title">Seluruh Prestasi</h2>
                <p>
                    Berbagai pencapaian yang berhasil diraih oleh siswa dan sekolah.
                </p>
            </div>

            <div class="row g-4 mt-3">
                @forelse ($prestasi as $prestasis)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <a href="{{ route('prestasi.detail', $prestasis->id) }}">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
                                <div class="achievement-image">
                                    <img src="{{ $prestasis->gambar ? asset('storage/' . $prestasis->gambar) : asset('assets/img/default.jpg') }}"
                                        alt="{{ $prestasis->nama_prestasi }}" class="w-100 h-100 object-fit-cover">
                                </div>

                                <div class="card-body p-4">
                                    <span class="badge bg-primary-subtle text-primary mb-2">
                                        <i class="bi bi-trophy-fill me-1"></i>
                                        Prestasi
                                    </span>
                                    <h5 class="fw-bold">
                                        {{ $prestasis->nama_prestasi }}
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        {{ $prestasis->deskripsi ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada data prestasi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
