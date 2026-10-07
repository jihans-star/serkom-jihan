@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">TAMBAH BERITA</h1>
                <p class="text-muted mb-0">Tambahkan informasi atau berita sekolah terbaru.</p>
            </div>
        </div>
        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.berita.index') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Data Berita
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
            <form class="panel needs-validation" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-pencil-square" aria-hidden="true"></i><span>Informasi Berita</span></h2>
                        <p class="text-muted mb-0">Isi detail postingan berita di bawah ini.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label" for="judul">Judul Berita</label>
                        <input class="form-control" id="judul" name="judul" type="text" value="{{ old('judul') }}" required maxlength="50" placeholder="Masukkan judul berita">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="tanggal">Tanggal Publikasi</label>
                        <input class="form-control" id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="gambar">Gambar Utama</label>
                        <input class="form-control" id="gambar" name="gambar" type="file" accept="image/*" required>
                        <div class="form-text">Format yang didukung: JPG, JPEG, PNG, WEBP (Maks. 2MB).</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="status">Status Publikasi</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Published" {{ old('status', $berita->status ?? 'Published') === 'Published' ? 'selected' : '' }}>
                                Published (Publik)
                            </option>
                            <option value="Draft" {{ old('status', $berita->status ?? '') === 'Draft' ? 'selected' : '' }}>
                                Draft (Private)
                            </option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="isi">Isi Berita</label>
                        <textarea class="form-control" id="isi" name="isi" rows="6" required placeholder="Tuliskan isi berita di sini...">{{ old('isi') }}</textarea>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.berita.index') }}">Batal</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-lg" aria-hidden="true"></i> Simpan Berita
                    </button>
                </div>
            </form>
        </div>

        <div class="col-12 col-xl-4">
            <div class="panel h-100">
                <h2 class="h5 mb-3 section-title"><i class="bi bi-list-check" aria-hidden="true"></i><span>Panduan Input</span></h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-dot bg-success"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Judul & Tanggal</p>
                            <p class="text-muted small mb-0">Gunakan judul yang singkat dan menarik, maksimal 50 karakter.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-primary"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Gambar Utama</p>
                            <p class="text-muted small mb-0">Pastikan rasio gambar tajam dan jelas untuk header berita.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
