@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="text-center mt-3" data-aos="fade-up">
                <span class="section-subtitle">GALERI SEKOLAH</span>
                <h2 class="section-title">Dokumentasi Kegiatan</h2>
                <p>
                    Kumpulan foto dan video berbagai kegiatan dan momen di sekolah.
                </p>
            </div>

            <ul class="nav nav-tabs mt-4 mb-3" data-aos="fade-up">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#foto">Foto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#video">Video</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane container active" id="foto">
                    <div class="row g-3 mt-3">
                        @forelse ($galeriFoto as $galeris)
                            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                                <div class="activity-card">
                                    <div class="activity-image">
                                        <a href="{{ route('galeri.detail', $galeris->id) }}">
                                            <img src="{{ $galeris->file ? asset('storage/' . $galeris->file) : asset('assets/img/default.jpg') }}"
                                                alt="{{ $galeris->judul }}">
                                        </a>
                                    </div>

                                    <div class="activity-body">
                                        <a href="{{ route('galeri.detail', $galeris->id) }}">
                                            <h4>{{ $galeris->judul }}</h4>
                                        </a>

                                        <i class="bi bi-calendar-event me-2"></i>
                                        {{ $galeris->tanggal ? $galeris->tanggal->format('d M, Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>Belum ada foto.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="tab-pane container" id="video">
                    <div class="row g-3 mt-3">
                        @forelse ($galeriVideo as $galeris)
                            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                                <div class="activity-card">
                                    <div class="activity-image">
                                        <video controls>
                                            <source src="{{ asset('storage/' . $galeris->file) }}" type="video/mp4">
                                            Browser kamu tidak mendukung pemutaran video.
                                        </video>
                                    </div>

                                    <div class="activity-body">
                                        <a href="{{ route('galeri.detail', $galeris->id) }}">
                                            <h4>{{ $galeris->judul }}</h4>
                                        </a>

                                        <i class="bi bi-calendar-event me-2"></i>
                                        {{ $galeris->tanggal ? $galeris->tanggal->format('d M, Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p>Belum ada foto.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
