@extends('layouts.landing')
@section('content')
    <section class="hero-section">
        <div class="hero-background"
            style="background-image: url('{{ $profil && $profil->foto ? asset('storage/' . $profil->foto) : asset('assets/img/sekolah.jpg') }}');">
        </div>

        <div class="container position-relative">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="hero-subtitle">SELAMAT DATANG DI</span>
                    <h1>{{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}</h1>
                    <p>
                        {{ $profil->deskripsi ?? 'Mewujudkan generasi unggul, berkarakter, berprestasi, dan siap menghadapi masa depan.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>



    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden p-4 p-lg-5">
                <div class="row align-items-center g-5">
                    <div class="col-lg-4 text-center text-lg-start" data-aos="fade-right">
                        <div class="position-relative d-inline-block w-100">
                            <img src="{{ $profil->foto_kepala_sekolah ? asset('storage/' . $profil->foto_kepala_sekolah) : asset('assets/img/default-user.jpg') }}"
                                alt="{{ $profil->kepala_sekolah ?? 'Kepala Sekolah' }}"
                                class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover m-auto"
                                style="max-width: 350px; height: 420px;">
                        </div>

                        <div class="mt-3 text-center">
                            <h4 class="fw-bold mb-0 text-dark">
                                {{ $profil->kepala_sekolah ?? '-' }}
                            </h4>
                        </div>
                    </div>

                    <div class="col-lg-8" data-aos="fade-left">
                        <div class="ps-lg-3">
                            <div class="mb-3">
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold small">
                                    SAMBUTAN KEPALA SEKOLAH
                                </span>
                            </div>

                            <h2 class="fw-bold mb-4 text-dark display-6">
                                Membangun Generasi <br class="d-none d-md-inline">
                                <span class="text-primary">Unggul & Berkarakter</span>
                            </h2>

                            <p class="fs-6 fw-medium text-dark mb-3">
                                Assalamu'alaikum Warahmatullahi Wabarakatuh.
                            </p>

                            <p class="text-secondary lh-lg mb-3">
                                Selamat datang di website resmi
                                <strong class="text-dark">{{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}</strong>.
                                Kami berkomitmen untuk memberikan pendidikan yang berkualitas serta membentuk peserta didik
                                yang unggul, berkarakter, berprestasi, dan siap menghadapi tantangan masa depan.
                            </p>

                            <p class="text-secondary lh-lg mb-4">
                                Semoga website ini dapat menjadi jendela informasi yang transparan serta bermanfaat bagi
                                seluruh warga sekolah, orang tua, dan masyarakat luas.
                            </p>

                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <a href="{{ route('profil') }}"
                                    class="btn btn-primary px-4 py-2 rounded-pill shadow-sm d-inline-flex align-items-center">
                                    <span>Lihat Profil Sekolah</span>
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-dark text-white">
        <div class="container py-4">
            <div class="row g-4 text-center">

                <div class="col-6 col-lg-3" data-aos="fade-up">
                    <div class="p-3">
                        <i class="bi bi-mortarboard-fill fs-1 text-white"></i>
                        <h2 class="fw-bold mt-2">{{ $jumlahSiswa }}</h2>
                        <p class="text-secondary mb-0">Siswa</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-3">
                        <i class="bi bi-person-workspace fs-1 text-white"></i>
                        <h2 class="fw-bold mt-2">{{ $jumlahGuru }}</h2>
                        <p class="text-secondary mb-0">Guru</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-3">
                        <i class="bi bi-trophy-fill fs-1 text-white"></i>
                        <h2 class="fw-bold mt-2">{{ $jumlahPrestasi }}</h2>
                        <p class="text-secondary mb-0">Prestasi</p>
                    </div>
                </div>

                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-3">
                        <i class="bi bi-people-fill fs-1 text-white"></i>
                        <h2 class="fw-bold mt-2">{{ $jumlahEkstrakurikuler }}</h2>
                        <p class="text-secondary mb-0">Ekstrakurikuler</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="section-padding">
        <div class="container">
            <div class="section-heading text-center" data-aos="fade-up">
                <span class="section-subtitle">TENAGA PENDIDIK & KEPENDIDIKAN</span>
                <h2 class="section-title">Guru & Tenaga Kependidikan</h2>
                <p>
                    Para pendidik dan tenaga kependidikan yang berkomitmen memberikan layanan pendidikan terbaik untuk
                    mendukung prestasi dan perkembangan peserta didik.
                </p>
            </div>

            <div class="swiper slider mt-4" data-aos="fade-up">
                <div class="swiper-wrapper">
                    @forelse ($guru as $gurus)
                        <div class="swiper-slide">
                            <a href="{{ route('guru.detail', $gurus->id) }}" class="text-decoration-none">
                                <div class="teacher-card">
                                    <div class="teacher-image">
                                        <img src="{{ $gurus->foto ? asset('storage/' . $gurus->foto) : asset('assets/img/default-user.jpg') }}"
                                            alt="{{ $gurus->nama_guru }}">
                                    </div>

                                    <div class="teacher-body">
                                        <h4>{{ $gurus->nama_guru }}</h4>
                                        <p>{{ $gurus->mapel ?? 'Guru' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="w-100 text-center">
                            <p>Belum ada data guru.</p>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination mt-5"></div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('guru') }}" class="btn btn-primary rounded-pill">
                    Lihat Semua
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-heading text-center" data-aos="fade-up">
                <span class="section-subtitle">KEGIATAN SISWA</span>
                <h2 class="section-title">Ekstrakurikuler</h2>
                <p>
                    Berbagai kegiatan untuk mengembangkan minat, bakat, dan kreativitas siswa.
                </p>
            </div>

            <div class="swiper slider mt-4" data-aos="fade-up">
                <div class="swiper-wrapper">
                    @forelse ($ekstrakurikuler as $ekskul)
                        <div class="swiper-slide">
                            <a href="{{ route('ekstrakurikuler.detail', $ekskul->id) }}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-hover">
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
                        <div class="w-100 text-center">
                            <p>Belum ada data ekstrakurikuler.</p>
                        </div>
                    @endforelse
                </div>
                {{-- <div class="swiper-pagination mt-5"></div> --}}
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('ekstrakurikuler') }}" class="btn btn-primary rounded-pill">
                    Lihat Semua
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="section-heading text-center" data-aos="fade-up">
                <span class="section-subtitle">PENCAPAIAN SEKOLAH</span>
                <h2 class="section-title">Prestasi Terbaru</h2>
                <p>
                    Berbagai pencapaian yang berhasil diraih oleh siswa dan sekolah.
                </p>
            </div>

            <div class="swiper slider mt-4" data-aos="fade-up">
                <div class="swiper-wrapper">
                    @forelse ($prestasi as $prestasis)
                        <div class="swiper-slide">
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
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada data prestasi.</p>
                        </div>
                    @endforelse
                </div>
            </div>


            <div class="text-center mt-5">
                <a href="{{ route('prestasi') }}" class="btn btn-primary rounded-pill">
                    Lihat Semua
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="section-padding bg-light">
        <div class="container">
            <div class="section-heading text-center" data-aos="fade-up">
                <span class="section-subtitle">DOKUMENTASI</span>
                <h2 class="section-title">Galeri Terbaru</h2>
                <p>
                    Dokumentasi kegiatan dan berbagai momen di
                    {{ $profil->nama_sekolah ?? 'SMA Nova Cendekia' }}.
                </p>
            </div>

            <div class="swiper slider mt-4" data-aos="fade-up">
                <div class="swiper-wrapper">
                @forelse ($galeri as $galeris)
                    <div class="swiper-slide">
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

            <div class="text-center mt-5">
                <a href="{{ route('galeri') }}" class="btn btn-primary rounded-pill">
                    Lihat Semua
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="section-heading text-center" data-aos="fade-up">
                <span class="section-subtitle">INFORMASI TERKINI</span>
                <h2 class="section-title">Berita Terbaru</h2>
                <p>
                    Informasi dan berita terbaru seputar kegiatan sekolah.
                </p>
            </div>

            <div class="row g-4 mt-3">
                @forelse ($berita as $beritas)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <a href="{{ route('berita.detail', $beritas->slug) }}">
                            <div class="news-card">
                                <div class="news-image">
                                    <img src="{{ $beritas->gambar ? asset('storage/' . $beritas->gambar) : asset('assets/img/default.jpg') }}"
                                        alt="{{ $beritas->judul }}">
                                </div>

                                <div class="news-body">
                                    <small>
                                        <i class="bi bi-calendar-event me-2"></i>
                                        {{ $beritas->tanggal ? $beritas->tanggal->format('d M, Y') : '-' }}
                                    </small>

                                    <h4>{{ $beritas->judul }}</h4>

                                    <p>
                                        {{ Str::limit(strip_tags($beritas->isi), 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Belum ada berita.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('berita') }}" class="btn btn-primary rounded-pill">
                    Lihat Semua
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
