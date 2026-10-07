@extends('layouts.admin')
@section('content')
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-gear" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Manajemen</p>
                <h1 class="h3 mb-1">Edit Akun</h1>
                <p class="text-muted mb-0">Tinjau atau ubah detail untuk {{ $user->name }}.</p>
              </div>
            </div>
            <div class="heading-actions">
                <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.user.index') }}">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Kembali ke Pengelola
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
              {{-- Form langsung diarahkan ke proses update --}}
              <form class="panel needs-validation" action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title"><i class="bi bi-info-circle" aria-hidden="true"></i><span>Informasi Pengelola</span></h2>
                        <p class="text-muted mb-0">Perbarui kolom di bawah lalu klik simpan.</p>
                    </div>
                </div>

                <div class="row g-3">
                  <div class="col-md-12">
                      <label class="form-label" for="name">Nama Lengkap</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="username">Username</label>
                      <input class="form-control" id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label" for="password">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                      <input class="form-control" id="password" name="password" type="password">
                  </div>

                  {{-- Peran diubah menjadi combobox (select) agar bisa dipilih --}}
                  <div class="col-md-6">
                      <label class="form-label" for="role">Peran (Role)</label>
                      <select class="form-select" id="role" name="role" required>
                          <option value="" disabled>Pilih Peran</option>
                          <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                          <option value="Operator" {{ old('role', $user->role) == 'Operator' ? 'selected' : '' }}>Operator</option>
                      </select>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label text-muted small mb-1">Tanggal Bergabung</label>
                      <input class="form-control bg-light" type="text" value="{{ $user->created_at->format('d M, Y - H:i') }}" readonly>
                  </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.user.index') }}">Batal</a>
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
                  <div class="activity-item"><span class="activity-dot bg-primary"></span><div><p class="mb-1 fw-semibold">Edit Langsung</p><p class="text-muted small mb-0">Anda dapat melihat dan mengubah data pengelola langsung dari layar ini.</p></div></div>
                </div>
              </div>
            </div>
          </section>
        </div>
@endsection
