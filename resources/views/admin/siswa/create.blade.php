@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">TAMBAH SISWA</h1>
                    <p class="text-muted mb-0">Tambahkan data siswa baru ke sistem.</p>
                </div>
            </div>
            <div class="heading-actions">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.siswa.index') }}">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Data Siswa
                </a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="row g-3 mt-1">
            <div class="col-12 col-xl-8">
                <form class="panel needs-validation" action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf
                    <div class="panel-header">
                        <div>
                            <h2 class="h5 mb-1 section-title"><i class="bi bi-person-plus"
                                    aria-hidden="true"></i><span>Informasi Siswa</span></h2>
                            <p class="text-muted mb-0">Isi detail data siswa di bawah ini.</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label" for="nama_siswa">Nama Lengkap Siswa</label>
                            <input class="form-control" id="nama_siswa" name="nama_siswa" type="text"
                                value="{{ old('nama_siswa') }}" required maxlength="40">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="nisn">NISN</label>
                            <input class="form-control" id="nisn" name="nisn" type="text"
                                value="{{ old('nisn') }}" required maxlength="10">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label" for="tahun_masuk">Tahun Masuk</label>
                            <select class="form-select" id="tahun_masuk" name="tahun_masuk" required>
                                <option value="" disabled selected>Pilih Tahun Masuk</option>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($year = $currentYear; $year >= $currentYear - 3; $year--)
                                    <option value="{{ $year }}" {{ old('tahun_masuk') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                        <a class="btn btn-outline-secondary" href="{{ route('admin.siswa.index') }}">Batal</a>
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-person-check" aria-hidden="true"></i> Simpan Data Siswa
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-12 col-xl-4">
                <div class="panel h-100">
                    <h2 class="h5 mb-3 section-title"><i class="bi bi-list-check" aria-hidden="true"></i><span>Panduan
                            Input</span></h2>
                    <div class="activity-list">
                        <div class="activity-item"><span class="activity-dot bg-success"></span>
                            <div>
                                <p class="mb-1 fw-semibold">NISN Unik</p>
                                <p class="text-muted small mb-0">Pastikan NISN benar dan belum terdaftar sebelumnya.</p>
                            </div>
                        </div>
                        <div class="activity-item"><span class="activity-dot bg-primary"></span>
                            <div>
                                <p class="mb-1 fw-semibold">Tahun Masuk</p>
                                <p class="text-muted small mb-0">Masukkan tahun format 4 digit angka (misal: 2026).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
