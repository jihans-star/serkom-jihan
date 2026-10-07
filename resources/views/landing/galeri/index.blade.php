@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container">
            <div class="text-center mt-3" data-aos="fade-up">
                <span class="section-subtitle">TENAGA PENDIDIK & KEPENDIDIKAN</span>
                <h2 class="section-title">Guru & Tenaga Kependidikan</h2>
                <p>
                    Para pendidik dan tenaga kependidikan yang berkomitmen memberikan layanan pendidikan terbaik untuk
                    mendukung prestasi dan perkembangan peserta didik.
                </p>
            </div>

            <div class="row g-3 mt-3">
                @forelse ($galeri as $galeris)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <div class="activity-card">
                            <div class="activity-image">
                                @if ($galeris->kategori === 'Foto')
                                    <a href="{{ route('galeri.detail', $galeris->id) }}">
                                        <img src="{{ $galeris->file ? asset('storage/' . $galeris->file) : asset('assets/img/default.jpg') }}"
                                            alt="{{ $galeris->judul }}">
                                    </a>
                                @elseif ($galeris->kategori === 'Video')
                                    <video controls>
                                        <source src="{{ asset('storage/' . $galeris->file) }}" type="video/mp4">
                                        Browser kamu tidak mendukung pemutaran video.
                                    </video>
                                @endif
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
                        <p>Belum ada data galeri.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
