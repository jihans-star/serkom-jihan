@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-lg-4 py-4">
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-controller" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">TAMBAH EKSTRAKURIKULER</h1>
                <p class="text-muted mb-0">Tambahkan informasi kegiatan ekstrakurikuler sekolah baru.</p>
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
            <form class="panel needs-validation" action="{{ route('admin.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-pencil-square" aria-hidden="true"></i><span>Informasi Ekstrakurikuler</span></h2>
                        <p class="text-muted mb-0">Isi detail ekstrakurikuler di bawah ini.</p>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label" for="nama_eskul">Nama Ekstrakurikuler</label>
                        <input class="form-control" id="nama_eskul" name="nama_eskul" type="text" value="{{ old('nama_eskul') }}" required maxlength="40" placeholder="Contoh: Paskibra / Pramuka">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="pembina">Nama Pembina</label>
                        <input class="form-control" id="pembina" name="pembina" type="text" value="{{ old('pembina') }}" required maxlength="40" placeholder="Masukkan nama pembina">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="jadwal_latihan">Jadwal Latihan</label>
                        <input class="form-control" id="jadwal_latihan" name="jadwal_latihan" type="text" value="{{ old('jadwal_latihan') }}" required maxlength="40" placeholder="Contoh: Setiap Jumat, 15:00 WIB">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="gambar">Gambar Utama</label>
                        <input class="form-control" id="gambar" name="gambar" type="file" accept="image/*" required>
                        <div class="form-text">Format yang didukung: JPG, JPEG, PNG, WEBP (Maks. 2MB).</div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required placeholder="Tuliskan deskripsi ekstrakurikuler di sini...">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.ekstrakurikuler.index') }}">Batal</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-lg" aria-hidden="true"></i> Simpan Ekstrakurikuler
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
                            <p class="mb-1 fw-semibold">Batas Karakter</p>
                            <p class="text-muted small mb-0">Nama eskul, pembina, dan jadwal latihan dibatasi maksimal 40 karakter.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-primary"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Deskripsi & Foto</p>
                            <p class="text-muted small mb-0">Berikan penjelasan lengkap mengenai kegiatan beserta foto dokumentasi terbaik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
