@extends('layouts.admin')
@section('content')
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">Edit Data Guru</h1>
                <p class="text-muted mb-0">Perbarui detail untuk {{ $guru->nama_guru }}.</p>
              </div>
            </div>
            <div class="heading-actions">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.guru.index') }}">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Data Guru
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
              <form class="panel needs-validation" action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Informasi Guru</span></h2>
                        <p class="text-muted mb-0">Perbarui kolom di bawah lalu klik simpan.</p>
                    </div>
                </div>

                <div class="row g-3">
                  <div class="col-md-12">
                      <label class="form-label" for="nama_guru">Nama Lengkap & Gelar</label>
                      <input class="form-control" id="nama_guru" name="nama_guru" type="text" value="{{ old('nama_guru', $guru->nama_guru) }}" required maxlength="40">
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="nip">NIP</label>
                      <input class="form-control" id="nip" name="nip" type="text" value="{{ old('nip', $guru->nip) }}" required maxlength="15">
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="mapel">Mata Pelajaran</label>
                      <input class="form-control" id="mapel" name="mapel" type="text" value="{{ old('mapel', $guru->mapel) }}" required maxlength="40">
                  </div>

                  <div class="col-md-12">
                      <label class="form-label" for="foto">Foto Guru <small class="text-muted">(Kosongkan jika tidak ingin mengubah foto)</small></label>

                      @if($guru->foto)
                          <div class="mb-2">
                              <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama_guru }}" class="rounded" width="70" height="70" style="object-fit: cover;">
                          </div>
                      @endif

                      <input class="form-control" id="foto" name="foto" type="file" accept="image/*">
                      <div class="form-text">Format yang didukung: JPG, JPEG, PNG.</div>
                  </div>

                  <div class="col-md-12">
                      <label class="form-label text-muted small mb-1">Tanggal Bergabung</label>
                      <input class="form-control bg-light" type="text" value="{{ $guru->created_at->format('d M, Y - H:i') }}" readonly>
                  </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.guru.index') }}">Batal</a>
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
                  <div class="activity-item"><span class="activity-dot bg-primary"></span><div><p class="mb-1 fw-semibold">Pembaruan Data</p><p class="text-muted small mb-0">Pastikan NIP dan mata pelajaran sudah sesuai sebelum menyimpan perubahan.</p></div></div>
                </div>
              </div>
            </div>
          </section>
        </div>
@endsection
