@extends('layouts.landing')

@section('content')
    <section class="section-padding">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="bg-white py-4 px-4 rounded-4 shadow-sm">
                        <h2 class="fw-bold text-dark mb-3">{{ $ekstrakurikuler->nama_eskul }}</h2>

                        <p class="text-muted mb-4 pb-3 border-bottom">
                            <i class="bi bi-person-badge text-primary me-1"></i> Pembina:
                            <strong>{{ $ekstrakurikuler->pembina }}</strong>
                            <span class="mx-2">•</span>
                            <i class="bi bi-calendar-event text-primary me-1"></i> Jadwal:
                            <strong>{{ $ekstrakurikuler->jadwal_latihan }}</strong>
                        </p>

                        @if ($ekstrakurikuler->gambar)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}"
                                    alt="{{ $ekstrakurikuler->nama_eskul }}" class="img-fluid rounded-4 w-100 shadow-sm"
                                    style="max-height: 420px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="eskul-content text-secondary lh-lg mb-4">
                            {{ $ekstrakurikuler->deskripsi }}
                        </div>

                        <div class="pt-3 border-top mt-5">
                            <a href="{{ route('ekstrakurikuler') }}"
                                class="text-decoration-none text-primary fw-semibold d-inline-flex align-items-center">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Ekstrakurikuler
                            </a>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 bg-light overflow-hidden">
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                Ekstrakurikuler Lainnya
                            </h5>
                        </div>

                        <div class="card-body p-3">
                            <div class="d-flex flex-column gap-3">
                                @foreach ($ekstrakurikulerLainnya as $item)
                                    <a href="{{ route('ekstrakurikuler.detail', $item->id) }}"
                                        class="text-decoration-none bg-white p-2.5 rounded-3 shadow-xs d-block transition-all hover-shadow">
                                        <div class="d-flex align-items-center">
                                            @if ($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                    alt="{{ $item->nama_eskul }}"
                                                    class="rounded-3 me-3 flex-shrink-0 object-fit-cover shadow-xs"
                                                    height="60" width="60">
                                            @endif
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-dark fw-semibold lh-sm" style="font-size: 13.5px;">
                                                    {{ Str::limit($item->nama_eskul, 38) }}
                                                </h6>
                                                <small class="text-muted d-flex align-items-center"
                                                    style="font-size: 11px;">
                                                    <i class="bi bi-clock me-1"></i>
                                                    {{ Str::limit($item->jadwal_latihan, 25) }}
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
