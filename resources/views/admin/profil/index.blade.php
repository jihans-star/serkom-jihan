@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi kesalahan, silakan periksa kembali form Anda.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="page-heading mb-4">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Akun</p>
                    <h1 class="h3 mb-1">Profil Saya</h1>
                    <p class="text-muted mb-0">Kelola detail informasi pribadi dan keamanan akun Anda.</p>
                </div>
            </div>
        </div>

        <section class="row g-4">
            <div class="col-12 col-xl-4">
                <div class="panel h-100 text-center profile-card p-4 shadow-sm">

                    <!-- Avatar Ikon Bawaan (Tanpa Cover) -->
                    <div class="mb-3 pt-3">
                        <div class="avatar-img avatar-xl rounded-circle profile-photo shadow d-inline-flex align-items-center justify-content-center bg-secondary text-white fs-1 mx-auto mt-2"
                            style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>

                    <h2 class="h5 mt-2 mb-1">{{ $user->name }}</h2>
                    <p class="text-muted mb-3">{{ '@' . $user->username }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge text-bg-primary">{{ $user->role }}</span>
                        <span class="badge text-bg-success">Aktif</span>
                    </div>

                    <div class="info-list mt-4 text-start border-top pt-3">
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Username</span>
                            <strong>{{ $user->username }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Role Akses</span>
                            <strong>{{ $user->role }}</strong>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Bergabung</span>
                            <strong>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Form Update Profil & Password -->
            <div class="col-12 col-xl-8">

                <!-- Form Update Profil (Nama & Email) -->
                <form action="{{ route('profile.update') }}" method="POST"
                    class="panel needs-validation p-4 mb-4 shadow-sm" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="profileName">Nama Lengkap</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="profileName" type="text"
                                name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="profileUsername">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror" id="profileUsername"
                                type="text" name="username" value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check2-circle me-1" aria-hidden="true"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>

                <!-- Form Ganti Password -->
                <form action="{{ route('profile.password') }}" method="POST"
                    class="panel needs-validation p-4 shadow-sm" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="panel-header mb-3">
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-shield-lock me-2" aria-hidden="true"></i><span>Keamanan (Ganti Password)</span>
                        </h2>
                        <p class="text-muted mb-0">Pastikan akun Anda menggunakan kata sandi yang aman.</p>
                    </div>

                    <div class="row g-3">
                        <!-- Password Lama -->
                        <div class="col-12">
                            <label class="form-label" for="currentPassword">Password Saat Ini</label>
                            <input class="form-control @error('password_lama') is-invalid @enderror" id="currentPassword"
                                type="password" name="password_lama" required>
                            @error('password_lama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Baru -->
                        <div class="col-md-6">
                            <label class="form-label" for="newPassword">Password Baru</label>
                            <input class="form-control @error('password_baru') is-invalid @enderror" id="newPassword"
                                type="password" name="password_baru" required>
                            @error('password_baru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="col-md-6">
                            <label class="form-label" for="confirmPassword">Konfirmasi Password Baru</label>
                            <input class="form-control" id="confirmPassword" type="password"
                                name="password_baru_confirmation" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-warning text-white" type="submit">
                            <i class="bi bi-key me-1" aria-hidden="true"></i> Perbarui Password
                        </button>
                    </div>
                    </form>

            </div>
        </section>
    </div>
@endsection
