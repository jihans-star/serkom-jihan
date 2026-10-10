@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="bg-white px-4 pt-3 rounded-4 shadow-sm">
                        <div class="gallery-details">
                            <span class="section-subtitle">
                                Detail Galeri Kegiatan
                            </span>
                            <h2 class="section-title mb-3">{{ $galeri->judul ?? 'Galeri Sekolah' }}</h2>

                            @if ($galeri->file)
                                <div class="mb-4">
                                    @if ($galeri->kategori === 'Foto')
                                        <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}"
                                            class="img-fluid rounded-4 w-100 shadow-sm"
                                            style="max-height: 480px; object-fit: cover;">
                                    @elseif ($galeri->kategori === 'Video')
                                        <video controls class="w-100 rounded-4 shadow-sm">
                                            <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                                            Browser kamu tidak mendukung pemutaran video.
                                        </video>
                                    @endif
                                </div>
                            @endif

                            <div class="gallery-content text-secondary lh-lg">
                                {{ $galeri->deskripsi ?? ($galeri->keterangan ?? 'Tidak ada deskripsi untuk galeri ini.') }}
                            </div>
                        </div>
                        <div class="py-3 border-top mt-5">
                            <a href="{{ route('galeri') }}"
                                class="text-decoration-none text-primary fw-semibold d-inline-flex align-items-center">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Galeri
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 bg-light overflow-hidden">
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                {{ $galeri->kategori }} Lainnya
                            </h5>
                        </div>

                        <div class="card-body p-3">
                            <div class="d-flex flex-column gap-3">
                                @foreach ($galeriLainnya as $item)
                                    <a href="{{ route('galeri.detail', $item->id) }}"
                                        class="text-decoration-none bg-white p-2.5 rounded-3 shadow-xs d-block transition-all hover-shadow">
                                        <div class="d-flex align-items-center">
                                            @if ($item->kategori === 'Foto' && $item->file)
                                                <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->judul }}"
                                                    class="rounded-3 me-3 flex-shrink-0 object-fit-cover shadow-xs"
                                                    height="65" width="65">
                                            @elseif ($item->kategori === 'Video')
                                                <div class="bg-primary text-white rounded-3 me-3 flex-shrink-0 d-flex align-items-center justify-content-center"
                                                    style="height: 65px; width: 65px;">
                                                    <i class="bi bi-play-circle-fill fs-3"></i>
                                                </div>
                                            @endif
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-dark fw-semibold lh-sm" style="font-size: 13.5px;">
                                                    {{ Str::limit($item->judul ?? 'Dokumentasi Sekolah', 40) }}
                                                </h6>
                                                <small class="text-muted d-flex align-items-center"
                                                    style="font-size: 11.5px;">
                                                    <i
                                                        class="bi bi-calendar-event me-1"></i>{{ $item->tanggal->format('d M, Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
