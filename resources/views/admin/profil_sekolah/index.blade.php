@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="page-heading-copy d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded-3 text-primary">
                    <i class="bi bi-building fs-3" aria-hidden="true"></i>
                </div>
                <div>
                    <p class="eyebrow mb-1 text-uppercase text-muted small fw-bold tracking-wider">Manajemen Sekolah</p>
                    <h1 class="h3 mb-1 fw-bold">Profil & Kepala Sekolah</h1>
                    <p class="text-muted mb-0">Kelola identitas institusi dan informasi khusus pimpinan sekolah.</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="row g-4">
            <div class="col-12 col-xl-4 d-flex flex-column gap-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="position-relative bg-light" style="min-height: 160px;">
                        @if ($profil && $profil->foto)
                            <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Sekolah"
                                class="w-100 object-fit-cover" style="height: 160px;">
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center text-muted"
                                style="height: 160px;">
                                <i class="bi bi-building fs-2 mb-1"></i>
                                <span class="small">Belum ada foto sekolah</span>
                            </div>
                        @endif
                        <span class="badge bg-dark bg-opacity-75 position-absolute top-0 end-0 m-2 px-2 py-1 small">
                            <i class="bi bi-camera me-1"></i> Utama
                        </span>
                    </div>

                    <diwv class="card-body text-center p-4 pt-0 position-relative">
                        <div class="mb-3" style="margin-top: -40px;">
                            @if ($profil && $profil->logo)
                                <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Sekolah"
                                    class="rounded-circle bg-white shadow-sm border border-3 border-white object-fit-cover"
                                    width="80" height="80">
                            @else
                                <div class="rounded-circle bg-white shadow-sm border border-3 border-white d-inline-flex align-items-center justify-content-center text-muted mx-auto bg-light"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-building fs-4"></i>
                                </div>
                            @endif
                        </div>

                        <h2 class="h6 fw-bold mb-1">{{ $profil->nama_sekolah ?? 'Nama Sekolah Belum Diatur' }}</h2>
                        <div class="d-flex justify-content-center gap-2 my-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill small">NPSN:
                                {{ $profil->npsp ?? ($profil->npsp ?? '-') }}</span>
                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill small">Est.
                                {{ $profil->tahun_berdiri ?? '-' }}</span>
                        </div>

                        <div class="text-start border-top pt-3 mt-3">
                            <div class="mb-2">
                                <span class="text-muted d-block" style="font-size: 0.75rem;"><i
                                        class="bi bi-telephone me-1"></i> Kontak</span>
                                <strong class="small text-dark">{{ $profil->kontak ?? '-' }}</strong>
                            </div>
                            <div>
                                <span class="text-muted d-block" style="font-size: 0.75rem;"><i
                                        class="bi bi-geo-alt me-1"></i> Alamat</span>
                                <span class="small text-dark d-block text-truncate">{{ $profil->alamat ?? '-' }}</span>
                            </div>
                        </div>
                    </diwv>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                        <div class="d-flex align-items-center gap-2 text-primary">
                            <i class="bi bi-person-badge fs-5"></i>
                            <h6 class="mb-0 fw-bold text-dark">Informasi Kepala Sekolah</h6>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            @if ($profil && $profil->foto_kepala_sekolah)
                                <img src="{{ asset('storage/' . $profil->foto_kepala_sekolah) }}" alt="Foto Kepala Sekolah"
                                    class="rounded-circle object-fit-cover shadow-sm border border-3 border-light mx-auto"
                                    width="100" height="100">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-secondary shadow-sm mx-auto border border-3 border-white"
                                    style="width: 100px; height: 100px;">
                                    <i class="bi bi-person-fill fs-1"></i>
                                </div>
                            @endif
                        </div>

                        <h5 class="fw-bold mb-1 text-dark">{{ $profil->kepala_sekolah ?? 'Belum diatur' }}</h5>
                        <p class="text-muted small mb-0">Pimpinan / Kepala Institusi Sekolah</p>
                    </div>
                </div>

            </div>
            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                    <form action="{{ route('admin.sekolah.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-4">
                            <div>
                                <h2 class="h5 fw-bold mb-1">Form Pengaturan Data</h2>
                                <p class="text-muted small mb-0">Ubah informasi profil dan pimpinan sekolah di sini.</p>
                            </div>
                            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">Mode Edit</span>
                        </div>

                        <div class="mb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="namaSekolah">Nama Sekolah</label>
                                    <input class="form-control" id="namaSekolah" type="text" name="nama_sekolah"
                                        value="{{ old('nama_sekolah', $profil->nama_sekolah ?? '') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="npsn">NPSN</label>
                                    <input class="form-control" id="npsp" type="text" name="npsp"
                                        value="{{ old('npsp', $profil->npsp ?? ($profil->npsp ?? '')) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="tahunBerdiri">Tahun Berdiri</label>
                                    <input class="form-control" id="tahunBerdiri" type="number" name="tahun_berdiri"
                                        value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="kontak">Kontak / Telepon</label>
                                    <input class="form-control" id="kontak" type="text" name="kontak"
                                        value="{{ old('kontak', $profil->kontak ?? '') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="foto">Ganti Foto Sekolah</label>
                                    <input class="form-control" id="foto" type="file" name="foto"
                                        accept="image/*">
                                    <div class="form-text small text-muted">Format: JPG, PNG (Opsional)</div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="logo">Ganti Logo Sekolah</label>
                                    <input class="form-control" id="logo" type="file" name="logo"
                                        accept="image/*">
                                    <div class="form-text small text-muted">Format: PNG, JPG (Opsional)</div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small" for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ old('alamat', $profil->alamat ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 pt-3 border-top">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="kepalaSekolah">Nama Kepala Sekolah &
                                        Gelar</label>
                                    <input class="form-control" id="kepalaSekolah" type="text" name="kepala_sekolah"
                                        value="{{ old('foto_kepala_sekolah', $profil->kepala_sekolah ?? '') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small" for="foto_kepala_sekolah">Ganti Foto
                                        Kepala Sekolah</label>
                                    <input class="form-control" id="foto_kepala_sekolah" type="file"
                                        name="foto_kepala_sekolah" accept="image/*">
                                    <div class="form-text small text-muted">Format: JPG, PNG (Opsional)</div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold small" for="visiMisi">Visi & Misi</label>
                                    <textarea class="form-control" id="visiMisi" name="visi_misi" rows="3" required>{{ old('visi_misi', $profil->visi_misi ?? '') }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold small" for="deskripsi">Deskripsi Sekolah</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $profil->deskripsi ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center gap-2 mt-4 pt-3 border-top">
                            <button class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" type="submit">
                                <i class="bi bi-check2-circle me-1" aria-hidden="true"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
