@extends('layouts.admin')
@section('content')
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">TAMBAH PENGELOLA</h1>
                <p class="text-muted mb-0">Buat akun pengelola baru.</p>
              </div>
            </div>
            <div class="heading-actions">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.user.index') }}">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Pengelola
                </a>
            </div>
          </div>

          {{-- Menampilkan pesan error validasi jika ada --}}
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
              <form class="panel needs-validation" action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-person-plus" aria-hidden="true"></i><span>Informasi Pengelola</span></h2>
                        <p class="text-muted mb-0">Isi detail akun di bawah ini.</p>
                    </div>
                </div>

                <div class="row g-3">
                  <div class="col-md-12">
                      <label class="form-label" for="name">Nama Lengkap</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="username">Username</label>
                      <input class="form-control" id="username" name="username" type="text" value="{{ old('username') }}" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="password">Password</label>
                      <input class="form-control" id="password" name="password" type="password" required>
                  </div>

                  {{-- Pilihan Role / Peran --}}
                  <div class="col-md-12">
                      <label class="form-label" for="role">Peran (Role)</label>
                      <select class="form-select" id="role" name="role" required>
                          <option value="" disabled selected>Pilih Peran</option>
                          <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                          <option value="Operator" {{ old('role') == 'Operator' ? 'selected' : '' }}>Operator</option>
                      </select>
                  </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.user.index') }}">Batal</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-person-check" aria-hidden="true"></i> Buat Pengelola
                    </button>
                </div>
              </form>
            </div>

            <div class="col-12 col-xl-4">
              <div class="panel h-100">
                <h2 class="h5 mb-3 section-title"><i class="bi bi-list-check" aria-hidden="true"></i><span>Daftar Periksa Akses</span></h2>
                <div class="activity-list">
                  <div class="activity-item"><span class="activity-dot bg-success"></span><div><p class="mb-1 fw-semibold">Pengaturan Peran</p><p class="text-muted small mb-0">Tentukan hak akses akun dengan memilih Admin atau Operator.</p></div></div>
                  <div class="activity-item"><span class="activity-dot bg-primary"></span><div><p class="mb-1 fw-semibold">Password Aman</p><p class="text-muted small mb-0">Gunakan kombinasi karakter yang kuat.</p></div></div>
                </div>
              </div>
            </div>
          </section>
        </div>
@endsection
