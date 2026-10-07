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

            <div class="row g-4 mt-3">
                @forelse ($guru as $gurus)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <a href="{{ route('guru.detail', $gurus->id) }}">
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
                    <div class="col-12 text-center">
                        <p>Belum ada data guru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
