@extends('layouts.landing')
@section('content')
    <section class="section-padding">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="bg-white px-4 pt-3 rounded-4 shadow-sm">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-primary-subtle text-primary px-3 py-1.5 rounded-pill">
                                {{ $prestasi->kategori }}
                            </span>
                            <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill">
                                Tingkat {{ $prestasi->tingkat }}
                            </span>
                        </div>

                        <h2 class="fw-bold text-dark mb-3">{{ $prestasi->nama_prestasi }}</h2>

                        <p class="text-muted mb-4 pb-2 border-bottom">
                            <i class="bi bi-person text-primary me-1"></i> Peraih:
                            <strong>{{ $prestasi->nama_peraih }}</strong>
                            <span class="mx-2">•</span>
                            <i class="bi bi-calendar text-primary me-1"></i>
                            {{ $prestasi->tanggal_perolehan->format('d M, Y') }}
                        </p>

                        @if ($prestasi->gambar)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $prestasi->gambar) }}" alt="{{ $prestasi->nama_prestasi }}"
                                    class="img-fluid rounded-4 w-100 shadow-sm"
                                    style="max-height: 420px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="prestasi-content text-secondary lh-lg mb-4">
                            {{ $prestasi->deskripsi }}
                        </div>

                        <div class="py-3 border-top mt-5">
                            <a href="{{ route('prestasi') }}"
                                class="text-decoration-none text-primary fw-semibold d-inline-flex align-items-center">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Prestasi
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 bg-light overflow-hidden">
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                Prestasi Lainnya
                            </h5>
                        </div>

                        <div class="card-body p-3">
                            <div class="d-flex flex-column gap-3">
                                @foreach ($prestasiLainnya as $item)
                                    <a href="{{ route('prestasi.detail', $item->slug) }}"
                                        class="text-decoration-none bg-white p-2.5 rounded-3 shadow-xs d-block transition-all hover-shadow">
                                        <div class="d-flex align-items-center">
                                            @if ($item->gambar)
                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                    alt="{{ $item->nama_prestasi }}"
                                                    class="rounded-3 me-3 flex-shrink-0 object-fit-cover shadow-xs"
                                                    height="60" width="60">
                                            @else
                                                <div class="bg-primary-subtle rounded-3 me-3 flex-shrink-0 d-flex align-items-center justify-content-center text-primary fw-bold"
                                                    style="height: 60px; width: 60px;">
                                                    <i class="bi bi-award fs-4"></i>
                                                </div>
                                            @endif
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-dark fw-semibold lh-sm" style="font-size: 13.5px;">
                                                    {{ Str::limit($item->nama_prestasi, 38) }}
                                                </h6>
                                                <small class="text-muted d-flex align-items-center"
                                                    style="font-size: 11px;">
                                                    <i class="bi bi-person me-1"></i>
                                                    {{ Str::limit($item->nama_peraih, 25) }}
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
