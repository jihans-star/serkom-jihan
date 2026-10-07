@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">SISWA</h1>
                    <p class="text-muted mb-0">Tinjau data siswa SMA NOVA Cendekia</p>
                </div>
            </div>

            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.siswa.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title h6" id="importModalLabel">
                                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Import CSV Siswa
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file" class="form-label small fw-semibold">
                                        Pilih file (Format .CSV)
                                    </label>
                                    <input type="file" name="file" id="file" class="form-control form-control-sm"
                                        accept=".csv" required>
                                    <div class="form-text small text-muted mt-2">
                                        Pastikan file Excel kamu disimpan/di-save as ke format
                                        <strong>CSV (Comma Delimited)</strong> dengan urutan kolom:
                                        <br>
                                        <code>NISN, Nama Siswa, Jenis Kelamin, Tahun Masuk</code>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Upload & Import
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <div class="dropdown-menu dropdown-menu-end p-3" style="min-width:220px;">
                    <form action="{{ route('admin.siswa.index') }}" method="GET">

                        <label class="form-label small fw-semibold">Jenis Kelamin</label>
                        <select class="form-select form-select-sm mb-2" name="gender">
                            <option value="">Semua</option>
                            <option value="Laki-laki" {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>

                        <label class="form-label small fw-semibold">Tahun Masuk</label>
                        <select class="form-select form-select-sm mb-3" name="tahun">
                            <option value="">Semua</option>
                            @foreach ($tahuns as $tahun_masuk)
                                <option value="{{ $tahun_masuk }}" {{ request('tahun') == $tahun_masuk ? 'selected' : '' }}>
                                    {{ $tahun_masuk }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary btn-sm w-100 mb-2">
                            <i class="bi bi-funnel me-1"></i> Terapkan
                        </button>

                        <a href="{{ route('admin.siswa.index') }}" class="btn btn-light btn-sm w-100 text-center">
                            Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="panel mt-3">
            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-table" aria-hidden="true"></i>
                        <span>Daftar Siswa</span>
                    </h2>
                    <p class="text-muted mb-0">Cari, tinjau, dan kelola data siswa.</p>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <input class="form-control form-control-sm table-search" type="search" placeholder="Cari..."
                        data-table-search="siswaTable" aria-label="Cari siswa">

                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#importModal">
                        <i class="bi bi-file-earmark-spreadsheet me-1"></i> Import
                    </button>

                    <a class="btn btn-primary btn-sm" href="{{ route('admin.siswa.create') }}">
                        <i class="bi bi-person-plus" aria-hidden="true"></i> Tambah
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0" id="siswaTable" data-searchable-table>
                    <thead>
                        <tr>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tahun Masuk</th>
                            <th scope="col">Bergabung</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $item)
                            <tr>
                                <td>
                                    {{ $item->nisn }}
                                </td>
                                <td>
                                    {{ $item->nama_siswa }}
                                </td>
                                <td>
                                    <span
                                        class="badge text-bg-{{ $item->jenis_kelamin == 'Laki-laki' ? 'primary' : 'success' }}">
                                        {{ $item->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    {{ $item->tahun_masuk }}
                                </td>
                                <td>
                                    {{ $item->created_at->format('d M, Y') }}
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.siswa.edit', $item->id) }}" class="btn btn-light btn-sm"
                                            title="Edit">
                                            <i class="bi bi-pencil-square text-warning" aria-hidden="true"
                                                style="color: #fd7e14 !important;"></i>
                                        </a>

                                        <form action="{{ route('admin.siswa.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus data siswa ini?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="bi bi-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">
                                    Tidak ada data siswa ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
                <p class="text-muted small mb-0">
                    Menampilkan {{ $siswas->firstItem() ?? 0 }} sampai {{ $siswas->lastItem() ?? 0 }} dari
                    {{ $siswas->total() }} data siswa
                </p>

                <nav aria-label="Navigasi halaman">
                    {{ $siswas->links() }}
                </nav>
            </div>
        </section>
    </div>
@endsection
