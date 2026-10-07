@extends('layouts.landing')

@section('content')
    <section class="section-padding">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <img src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('assets/img/default-user.jpg') }}"
                                    alt="{{ $guru->nama_guru }}" class="img-fluid rounded-4 shadow-sm object-fit-cover"
                                    style="width: 280px; height: 380px;">
                            </div>
                            <div class="col-md-8">
                                <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-2 rounded-pill fw-semibold">
                                    {{ $guru->mapel }}
                                </span>
                                <h2 class="fw-bold text-dark mb-2">{{ $guru->nama_guru }}</h2>
                                <p class="text-muted mb-3">
                                    NIP: {{ $guru->nip ?? '-' }}
                                </p>
                                <hr class="text-muted opacity-25">
                                <p class="text-secondary mb-0" style="font-size: 14.5px;">
                                    Tenaga pendidik profesional yang mengampu mata pelajaran
                                    <strong>{{ $guru->mapel }}</strong> di sekolah kami.
                                </p>
                            </div>
                            <div class="pt-3 border-top mt-5">
                                <a href="{{ route('guru') }}"
                                    class="text-decoration-none text-primary fw-semibold d-inline-flex align-items-center">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Guru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mt-5 mt-lg-0" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 bg-light overflow-hidden">
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h5 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                Guru Lainnya
                            </h5>
                        </div>

                        <div class="card-body p-3">
                            <div class="d-flex flex-column gap-3">
                                @foreach ($guruLainnya as $item)
                                    <a href="{{ route('guru.detail', $item->id) }}"
                                        class="text-decoration-none bg-white p-2.5 rounded-3 shadow-xs d-block transition-all hover-shadow">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('assets/img/default-user.jpg') }}"
                                                alt="{{ $item->nama_guru }}"
                                                class="rounded-circle me-3 flex-shrink-0 object-fit-cover shadow-xs"
                                                height="55" width="55">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1 text-dark fw-semibold lh-sm" style="font-size: 13.5px;">
                                                    {{ $item->nama_guru }}
                                                </h6>
                                                <small class="text-primary fw-medium" style="font-size: 11.5px;">
                                                    {{ $item->mapel }}
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
