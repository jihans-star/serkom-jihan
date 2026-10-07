@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-controller" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">Edit Ekstrakurikuler</h1>
                <p class="text-muted mb-0">Perbarui detail untuk ekstrakurikuler "{{ $ekstrakurikuler->nama_eskul }}".</p>
            </div>
        </div>
        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.ekstrakurikuler.index') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Data Ekstrakurikuler
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
            <form class="panel needs-validation" action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Informasi Ekstrakurikuler</span></h2>
                        <p class="text-muted mb-0">Perbarui kolom di bawah lalu klik simpan perubahan.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label" for="nama_eskul">Nama Ekstrakurikuler</label>
                        <input class="form-control" id="nama_eskul" name="nama_eskul" type="text" value="{{ old('nama_eskul', $ekstrakurikuler->nama_eskul) }}" required maxlength="40">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="pembina">Nama Pembina</label>
                        <input class="form-control" id="pembina" name="pembina" type="text" value="{{ old('pembina', $ekstrakurikuler->pembina) }}" required maxlength="40">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="jadwal_latihan">Jadwal Latihan</label>
                        <input class="form-control" id="jadwal_latihan" name="jadwal_latihan" type="text" value="{{ old('jadwal_latihan', $ekstrakurikuler->jadwal_latihan) }}" required maxlength="40">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="gambar">Gambar Utama <small class="text-muted">(Kosongkan jika tidak ingin mengubah gambar)</small></label>

                        @if($ekstrakurikuler->gambar)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar) }}" alt="{{ $ekstrakurikuler->nama_eskul }}" class="rounded" width="100" height="70" style="object-fit: cover;">
                            </div>
                        @endif

                        <input class="form-control" id="gambar" name="gambar" type="file" accept="image/*">
                        <div class="form-text">Format yang didukung: JPG, JPEG, PNG, WEBP.</div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label text-muted small mb-1">Tanggal Dibuat</label>
                        <input class="form-control bg-light" type="text" value="{{ $ekstrakurikuler->created_at->format('d M, Y - H:i') }}" readonly>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.ekstrakurikuler.index') }}">Batal</a>
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
                            <p class="mb-1 fw-semibold">Pembaruan Data</p>
                            <p class="text-muted small mb-0">Pastikan informasi jadwal dan pembina sudah benar sebelum memperbarui.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-warning"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Penggantian Gambar</p>
                            <p class="text-muted small mb-0">Jika mengunggah gambar baru, gambar yang lama akan otomatis terhapus dari sistem.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
