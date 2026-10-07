@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">

        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon">
                    <i class="bi bi-people" aria-hidden="true"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">PENGELOLA</h1>
                    <p class="text-muted mb-0">
                        Tinjau akun pengelola SMA NOVA Cendekia
                    </p>
                </div>
            </div>

            <div class="heading-actions">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel me-1"></i>
                        Filter
                    </button>

                    <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 220px;">

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">
                                Peran
                            </label>

                            <select class="form-select form-select-sm" id="filterRole">
                                <option value="">Semua Peran</option>
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold">
                                Status
                            </label>

                            <select class="form-select form-select-sm" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-primary btn-sm w-100" id="applyFilter">
                            <i class="bi bi-funnel me-1"></i>
                            Terapkan Filter
                        </button>

                        <button type="button" class="btn btn-light btn-sm w-100 mt-2" id="resetFilter">
                            Reset
                        </button>

                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <section class="panel mt-3">

            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-table" aria-hidden="true"></i>
                        <span>Daftar Pengelola</span>
                    </h2>

                    <p class="text-muted mb-0">
                        Cari, tinjau, dan kelola akun pengelola.
                    </p>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <input class="form-control form-control-sm table-search" type="search" placeholder="Cari..."
                        data-table-search="usersTable" aria-label="Cari pengguna">

                    <a class="btn btn-primary btn-sm" href="{{ route('admin.user.create') }}">
                        <i class="bi bi-person-plus"></i>
                        Tambah
                    </a>
                </div>
            </div>

            <div class="table-responsive">

                <table class="table align-middle mb-0" id="usersTable" data-searchable-table>

                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Bergabung</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($users as $item)
                            <tr>

                                <td>
                                    <span class="fw-semibold">
                                        {{ $item->name }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->username }}
                                </td>

                                <td>
                                    @if ($item->role === 'Admin')
                                        <span class="badge text-bg-primary">
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge text-bg-secondary">
                                            Operator
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status === 'Aktif')
                                        <span class="badge text-bg-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge text-bg-secondary">
                                            <i class="bi bi-dash-circle me-1"></i>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $item->created_at->format('d M, Y') }}
                                </td>

                                <td class="text-end">

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.user.show', $item->id) }}" class="btn btn-light btn-sm"
                                            title="Lihat / Edit">

                                            <i class="bi bi-pencil-square" style="color: #fd7e14 !important;"></i>

                                        </a>


                                        {{-- AKTIF / NONAKTIF --}}
                                        <form action="{{ route('admin.user.status', $item->id) }}" method="POST">

                                            @csrf
                                            @method('PATCH')

                                            @if ($item->status === 'Aktif')
                                                <button type="submit" class="btn btn-light btn-sm" title="Nonaktifkan"
                                                    onclick="return confirm('Nonaktifkan pengelola ini?')">

                                                    <i class="bi bi-person-x text-warning"></i>

                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-light btn-sm" title="Aktifkan"
                                                    onclick="return confirm('Aktifkan kembali pengelola ini?')">

                                                    <i class="bi bi-person-check text-success"></i>

                                                </button>
                                            @endif

                                        </form>


                                        {{-- HAPUS HANYA JIKA BELUM PUNYA BERITA --}}
                                        @if (!$item->beritas()->exists())
                                            <form action="{{ route('admin.user.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah kamu yakin ingin menghapus pengelola ini?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">

                                    Tidak ada data pengelola ditemukan.

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">

                <p class="text-muted small mb-0">
                    Menampilkan
                    {{ $users->firstItem() ?? 0 }}
                    sampai
                    {{ $users->lastItem() ?? 0 }}
                    dari
                    {{ $users->total() }}
                    data pengelola
                </p>

                <nav aria-label="Navigasi halaman">
                    {{ $users->links() }}
                </nav>

            </div>

        </section>

    </div>
@endsection
