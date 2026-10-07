@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">Edit Berita</h1>
                <p class="text-muted mb-0">Perbarui detail untuk berita "{{ $berita->judul }}".</p>
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
            <form class="panel needs-validation" action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Informasi Berita</span></h2>
                        <p class="text-muted mb-0">Perbarui kolom di bawah lalu klik simpan.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label" for="judul">Judul Berita</label>
                        <input class="form-control" id="judul" name="judul" type="text" value="{{ old('judul', $berita->judul) }}" required maxlength="50">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tanggal">Tanggal Publikasi</label>
                        <input class="form-control" id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', $berita->tanggal) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="status">Status Publikasi</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Published" {{ old('status', $berita->status ?? 'Published') === 'Published' ? 'selected' : '' }}>Published (Publik)</option>
                            <option value="Draft" {{ old('status', $berita->status ?? '') === 'Draft' ? 'selected' : '' }}>Draft (Private)</option>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="gambar">Gambar Berita <small class="text-muted">(Kosongkan jika tidak ingin mengubah gambar)</small></label>

                        @if($berita->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="rounded" width="100" height="70" style="object-fit: cover;">
                            </div>
                        @endif

                        <input class="form-control" id="gambar" name="gambar" type="file" accept="image/*">
                        <div class="form-text">Format yang didukung: JPG, JPEG, PNG, WEBP.</div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="isi">Isi Berita</label>
                        <textarea class="form-control" id="isi" name="isi" rows="6" required>{{ old('isi', $berita->isi) }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label text-muted small mb-1">Tanggal Dibuat</label>
                        <input class="form-control bg-light" type="text" value="{{ $berita->created_at->format('d M, Y - H:i') }}" readonly>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.berita.index') }}">Batal</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-lg" aria-hidden="true"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="col-12 col-xl-4">
            <div class="panel h-100">
                <h2 class="h5 mb-3 section-title"><i class="bi bi-shield-check" aria-hidden="true"></i><span>Info Singkat</span></h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-dot bg-primary"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Pembaruan Berita</p>
                            <p class="text-muted small mb-0">Pastikan judul dan isi berita sudah sesuai sebelum menyimpan perubahan.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-warning"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Status Draf & Publik</p>
                            <p class="text-muted small mb-0">Atur status ke <strong>Draft</strong> jika berita masih dalam tahap penyuntingan internal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
