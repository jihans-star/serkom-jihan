@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="text-center mt-3" data-aos="fade-up">
                <span class="section-subtitle">KEGIATAN SISWA</span>
                <h2 class="section-title">Ekstrakurikuler</h2>
                <p>
                    Berbagai kegiatan untuk mengembangkan minat, bakat, dan kreativitas siswa.
                </p>
            </div>

            <div class="row g-4 mt-3">
                @forelse ($ekstrakurikuler as $ekskul)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <a href="{{ route('ekstrakurikuler.detail', $ekskul->slug) }}">
                            <div class="activity-card">

                                <div class="activity-image">
                                    <img src="{{ $ekskul->gambar ? asset('storage/' . $ekskul->gambar) : asset('assets/img/default.jpg') }}"
                                        alt="{{ $ekskul->nama_eskul }}" class="w-100 h-100 object-fit-cover">
                                </div>

                                <div class="card-body p-4">
                                    <h5 class="fw-bold">
                                        {{ $ekskul->nama_eskul }}
                                    </h5>

                                    <p class="text-muted small mb-0">
                                        {{ $ekskul->deskripsi }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada data ekstrakurikuler.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
