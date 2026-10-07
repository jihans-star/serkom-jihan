@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy"> <span class="page-icon"> <i class="bi bi-person-gear" aria-hidden="true"></i>
                </span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1"> Edit Data Siswa </h1>
                    <p class="text-muted mb-0"> Perbarui detail untuk {{ $siswa->nama_siswa }}. </p>
                </div>
            </div>
            <div class="heading-actions"> <a class="btn btn-outline-secondary btn-sm"
                    href="{{ route('admin.siswa.index') }}"> <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke
                    Data Siswa </a> </div>
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
                <form class="panel needs-validation" action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST"
                    novalidate>
                    @csrf
                    @method('PUT')
                    <div class="panel-header">
                        <div>
                            <h2 class="h5 mb-1 section-title"> <i class="bi bi-info-circle" aria-hidden="true"></i>
                                <span>Informasi Siswa</span>
                            </h2>
                            <p class="text-muted mb-0"> Perbarui data siswa lalu klik simpan. </p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6"> <label class="form-label" for="nisn"> NISN </label> <input
                                class="form-control" id="nisn" name="nisn" type="text"
                                value="{{ old('nisn', $siswa->nisn) }}" maxlength="10" required>
                            <div class="invalid-feedback"> NISN wajib diisi. </div>
                        </div>
                        <div class="col-md-6"> <label class="form-label" for="nama_siswa"> Nama Lengkap Siswa </label>
                            <input class="form-control" id="nama_siswa" name="nama_siswa" type="text"
                                value="{{ old('nama_siswa', $siswa->nama_siswa) }}" maxlength="40" required>
                            <div class="invalid-feedback"> Nama siswa wajib diisi. </div>
                        </div>
                        <div class="col-md-6"> <label class="form-label" for="jenis_kelamin"> Jenis Kelamin </label> <select
                                class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value=""> -- Pilih Jenis Kelamin -- </option>
                                <option value="Laki-laki"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki </option>
                                <option value="Perempuan"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan </option>
                            </select>
                            <div class="invalid-feedback"> Jenis kelamin wajib dipilih. </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="tahun_masuk">Tahun Masuk</label>
                            <select class="form-select" id="tahun_masuk" name="tahun_masuk" required>
                                <option value="" disabled selected>Pilih Tahun Masuk</option>
                                @php
                                    $currentYear = date('Y');
                                @endphp
                                @for ($year = $currentYear; $year >= 2020; $year--)
                                    <option value="{{ $year }}" {{ old('tahun_masuk') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-12"> <label class="form-label text-muted small mb-1"> Data Ditambahkan </label>
                            <input class="form-control bg-light" type="text"
                                value="{{ $siswa->created_at ? $siswa->created_at->format('d M, Y - H:i') : '-' }}"
                                readonly>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4"> <a class="btn btn-outline-secondary"
                            href="{{ route('admin.siswa.index') }}"> Batal </a> <button class="btn btn-primary"
                            type="submit"> <i class="bi bi-check-lg" aria-hidden="true"></i> Simpan Perubahan </button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-xl-4">
                <div class="panel h-100">
                    <h2 class="h5 mb-3 section-title"> <i class="bi bi-shield-check" aria-hidden="true"></i> <span>Info
                            Singkat</span> </h2>
                    <div class="activity-list">
                        <div class="activity-item"> <span class="activity-dot bg-primary"></span>
                            <div>
                                <p class="mb-1 fw-semibold"> Pembaruan Data </p>
                                <p class="text-muted small mb-0"> Pastikan NISN, nama siswa, jenis kelamin, dan tahun masuk
                                    sudah sesuai sebelum menyimpan perubahan. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
