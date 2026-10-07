@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="blog-details">
                        <span class="section-subtitle">
                            {{ $berita->tanggal->format('d M, Y') }} | Oleh : {{ $berita->user->name ?? 'Admin' }}
                        </span>
                        <h2 class="section-title mb-3">{{ $berita->judul }}</h2>

                        @if ($berita->gambar)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="img-fluid rounded w-100" style="max-height: 450px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="blog-content">
                            {{ $berita->isi }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 bg-light overflow-hidden">
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                 Berita Lainnya
                            </h5>
                        </div>

                        <div class="card-body p-3">
                            <div class="list-group list-group-flush bg-transparent">
                                @foreach ($beritaLainnya as $item)
                                    <a href="{{ route('berita.detail', $item->slug) }}"
                                        class="list-group-item list-group-item-action bg-white border-0 mb-2 shadow-xs rounded-3 p-3 transition-all hover-shadow">
                                        <div class="d-flex align-items-center">
                                            @if ($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                                    class="rounded-3 me-3 flex-shrink-0 object-fit-cover" height="60"
                                                    width="60">
                                            @endif
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-dark fw-semibold lh-sm" style="font-size: 13.5px;">
                                                    {{ Str::limit($item->judul, 40) }}
                                                </h6>
                                                <small class="text-muted d-flex align-items-center" style="font-size: 12px;">
                                                    <i class="bi bi-calendar-event me-1"></i>{{ $item->tanggal->format('d M, Y') }}
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
