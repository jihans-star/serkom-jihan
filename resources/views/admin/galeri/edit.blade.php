@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-images" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">Edit Galeri</h1>
                <p class="text-muted mb-0">Perbarui detail untuk galeri "{{ $galeri->judul }}".</p>
            </div>
        </div>
        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.galeri.index') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Data Galeri
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
            <form class="panel needs-validation" action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Informasi Galeri</span></h2>
                        <p class="text-muted mb-0">Perbarui kolom di bawah lalu klik simpan.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label" for="judul">Judul Galeri</label>
                        <input class="form-control" id="judul" name="judul" type="text" value="{{ old('judul', $galeri->judul) }}" required maxlength="50">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="tanggal">Tanggal</label>
                        <input class="form-control" id="tanggal" name="tanggal" type="date" value="{{ old('tanggal', $galeri->tanggal) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="kategori">Kategori</label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                            <option value="Foto" {{ old('kategori', $galeri->kategori) === 'Foto' ? 'selected' : '' }}>Foto</option>
                            <option value="Video" {{ old('kategori', $galeri->kategori) === 'Video' ? 'selected' : '' }}>Video</option>
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="file">File Media <small class="text-muted">(Kosongkan jika tidak ingin mengubah file)</small></label>

                        @if($galeri->file)
                            <div class="mb-2">
                                @if($galeri->kategori === 'Foto')
                                    <img src="{{ asset('storage/' . $galeri->file) }}" alt="{{ $galeri->judul }}" class="rounded" width="100" height="70" style="object-fit: cover;">
                                @else
                                    <span class="badge text-bg-dark"><i class="bi bi-film me-1"></i> File Video Terunggah</span>
                                @endif
                            </div>
                        @endif

                        <input class="form-control" id="file" name="file" type="file" accept="image/*,video/*">
                        <div class="form-text">Format Foto (JPG, PNG, WEBP) atau Video (MP4, MOV). Maks. 10MB.</div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required>{{ old('keterangan', $galeri->keterangan) }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label text-muted small mb-1">Tanggal Dibuat</label>
                        <input class="form-control bg-light" type="text" value="{{ $galeri->created_at->format('d M, Y - H:i') }}" readonly>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.galeri.index') }}">Batal</a>
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
                            <p class="mb-1 fw-semibold">Pembaruan Galeri</p>
                            <p class="text-muted small mb-0">Pastikan judul, kategori, dan file media sudah sesuai sebelum menyimpan perubahan.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-warning"></span>
                        <div>
                            <p class="mb-1 fw-semibold">File Media</p>
                            <p class="text-muted small mb-0">Jika mengunggah file baru, file media yang lama akan otomatis diganti dari sistem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
