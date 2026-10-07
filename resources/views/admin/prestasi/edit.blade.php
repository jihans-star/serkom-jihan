@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy"> <span class="page-icon"><i class="bi bi-trophy" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">EDIT PRESTASI</h1>
                    <p class="text-muted mb-0">Perbarui data "{{ $prestasi->nama_prestasi }}".</p>
                </div>
            </div>

            <div class="heading-actions">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.prestasi.index') }}">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i>
                    Kembali ke Data Prestasi
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
                <form class="panel needs-validation" action="{{ route('admin.prestasi.update', $prestasi->id) }}"
                    method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="panel-header">
                        <div>
                            <h2 class="h5 mb-1 section-title">
                                <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                <span>Informasi Prestasi</span>
                            </h2>

                            <p class="text-muted mb-0">
                                Perbarui detail prestasi atau kejuaraan di bawah ini.
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">

                        {{-- Nama Prestasi --}}
                        <div class="col-md-12">
                            <label class="form-label" for="nama_prestasi">
                                Nama Prestasi / Kejuaraan
                            </label>

                            <input class="form-control" id="nama_prestasi" name="nama_prestasi" type="text"
                                value="{{ old('nama_prestasi', $prestasi->nama_prestasi) }}" required maxlength="100"
                                placeholder="Contoh: Juara 1 Olimpiade Matematika Tingkat Nasional">
                        </div>

                        {{-- Kategori --}}
                        <div class="col-md-6">
                            <label class="form-label" for="kategori">
                                Kategori
                            </label>

                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori</option>

                                <option value="Akademik"
                                    {{ old('kategori', $prestasi->kategori) == 'Akademik' ? 'selected' : '' }}>
                                    Akademik
                                </option>

                                <option value="Non Akademik"
                                    {{ old('kategori', $prestasi->kategori) == 'Non Akademik' ? 'selected' : '' }}>
                                    Non Akademik
                                </option>
                            </select>
                        </div>

                        {{-- Tingkat --}}
                        <div class="col-md-6">
                            <label class="form-label" for="tingkat">
                                Tingkat
                            </label>

                            <select class="form-select" id="tingkat" name="tingkat" required>
                                <option value="">Pilih Tingkat</option>

                                <option value="Sekolah"
                                    {{ old('tingkat', $prestasi->tingkat) == 'Sekolah' ? 'selected' : '' }}>
                                    Sekolah
                                </option>

                                <option value="Kecamatan"
                                    {{ old('tingkat', $prestasi->tingkat) == 'Kecamatan' ? 'selected' : '' }}>
                                    Kecamatan
                                </option>

                                <option value="Kabupaten/Kota"
                                    {{ old('tingkat', $prestasi->tingkat) == 'Kabupaten/Kota' ? 'selected' : '' }}>
                                    Kabupaten/Kota
                                </option>

                                <option value="Provinsi"
                                    {{ old('tingkat', $prestasi->tingkat) == 'Provinsi' ? 'selected' : '' }}>
                                    Provinsi
                                </option>

                                <option value="Nasional"
                                    {{ old('tingkat', $prestasi->tingkat) == 'Nasional' ? 'selected' : '' }}>
                                    Nasional
                                </option>

                                <option value="Internasional"
                                    {{ old('tingkat', $prestasi->tingkat) == 'Internasional' ? 'selected' : '' }}>
                                    Internasional
                                </option>
                            </select>
                        </div>

                        {{-- Nama Peraih --}}
                        <div class="col-md-6">
                            <label class="form-label" for="nama_peraih">
                                Nama Peraih (Siswa / Tim)
                            </label>

                            <input class="form-control" id="nama_peraih" name="nama_peraih" type="text"
                                value="{{ old('nama_peraih', $prestasi->nama_peraih) }}" required maxlength="100"
                                placeholder="Contoh: Budi Santoso / Tim Basket">
                        </div>

                        {{-- Tanggal --}}
                        <div class="col-md-6">
                            <label class="form-label" for="tanggal_perolehan">
                                Tanggal Perolehan
                            </label>

                            <input class="form-control" id="tanggal_perolehan" name="tanggal_perolehan" type="date"
                                value="{{ old('tanggal_perolehan', $prestasi->tanggal_perolehan) }}" required>
                        </div>

                        {{-- Gambar --}}
                        <div class="col-md-12">
                            <label class="form-label" for="gambar">
                                Foto Dokumentasi / Sertifikat
                                <small class="text-muted">
                                    (Kosongkan jika tidak ingin mengubah)
                                </small>
                            </label>

                            @if ($prestasi->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $prestasi->gambar) }}"
                                        alt="{{ $prestasi->nama_prestasi }}" class="rounded" width="120" height="80"
                                        style="object-fit: cover;">
                                </div>
                            @endif

                            <input class="form-control" id="gambar" name="gambar" type="file" accept="image/*">

                            <div class="form-text">
                                Format yang didukung: JPG, JPEG, PNG, WEBP (Maks. 2MB).
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-md-12">
                            <label class="form-label" for="deskripsi">
                                Deskripsi / Keterangan
                            </label>

                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required
                                placeholder="Tuliskan detail pencapaian, perlombaan, atau keterangan lainnya...">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                        </div>

                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">

                        <a class="btn btn-outline-secondary" href="{{ route('admin.prestasi.index') }}">
                            Batal
                        </a>

                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg" aria-hidden="true"></i>
                            Simpan Perubahan
                        </button>

                    </div>
                </form>
            </div>

            {{-- Panduan --}}
            <div class="col-12 col-xl-4">
                <div class="panel h-100">

                    <h2 class="h5 mb-3 section-title">
                        <i class="bi bi-list-check" aria-hidden="true"></i>
                        <span>Panduan Edit</span>
                    </h2>

                    <div class="activity-list">

                        <div class="activity-item">
                            <span class="activity-dot bg-success"></span>

                            <div>
                                <p class="mb-1 fw-semibold">
                                    Periksa Data Prestasi
                                </p>

                                <p class="text-muted small mb-0">
                                    Pastikan nama prestasi, kategori, tingkat,
                                    dan nama peraih sudah sesuai.
                                </p>
                            </div>
                        </div>

                        <div class="activity-item">
                            <span class="activity-dot bg-primary"></span>

                            <div>
                                <p class="mb-1 fw-semibold">
                                    Kategori & Tingkat
                                </p>

                                <p class="text-muted small mb-0">
                                    Pilih kategori dan tingkat prestasi melalui
                                    dropdown yang tersedia.
                                </p>
                            </div>
                        </div>

                        <div class="activity-item">
                            <span class="activity-dot bg-warning"></span>

                            <div>
                                <p class="mb-1 fw-semibold">
                                    Ganti Dokumentasi
                                </p>

                                <p class="text-muted small mb-0">
                                    Upload gambar baru hanya jika ingin mengganti
                                    dokumentasi yang sudah ada.
                                </p>
                            </div>
                        </div>

                        <div class="activity-item">
                            <span class="activity-dot bg-info"></span>

                            <div>
                                <p class="mb-1 fw-semibold">
                                    Deskripsi
                                </p>

                                <p class="text-muted small mb-0">
                                    Perbarui keterangan prestasi agar informasi
                                    yang ditampilkan tetap lengkap.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
