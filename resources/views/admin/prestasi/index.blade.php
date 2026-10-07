@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-trophy" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">PRESTASI SEKOLAH</h1>
                    <p class="text-muted mb-0">Tinjau dan kelola data prestasi siswa/sekolah.</p>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-funnel me-1"></i>
                    Filter
                </button>

                <div class="dropdown-menu dropdown-menu-end p-3" style="min-width:220px;">

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Kategori</label>

                        <select class="form-select form-select-sm" id="filterPrestasiKategori">
                            <option value="">Semua Kategori</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Non Akademik">Non Akademik</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Tingkat</label>

                        <select class="form-select form-select-sm" id="filterPrestasiTingkat">
                            <option value="">Semua Tingkat</option>
                            <option value="Sekolah">Sekolah</option>
                            <option value="Kecamatan">Kecamatan</option>
                            <option value="Kabupaten">Kabupaten</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary btn-sm w-100" id="applyPrestasiFilter">
                        <i class="bi bi-funnel me-1"></i>
                        Terapkan
                    </button>

                    <button type="button" class="btn btn-light btn-sm w-100 mt-2" id="resetPrestasiFilter">
                        Reset
                    </button>

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
                        <i class="bi bi-table" aria-hidden="true"></i><span>Daftar Prestasi</span>
                    </h2>
                    <p class="text-muted mb-0">Semua daftar penghargaan dan kejuaraan.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <input class="form-control form-control-sm table-search" type="search" placeholder="Cari prestasi..."
                        data-table-search="prestasiTable" aria-label="Cari prestasi">

                    <a class="btn btn-primary btn-sm" href="{{ route('admin.prestasi.create') }}">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="prestasiTable" data-searchable-table>
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Prestasi</th>
                            <th scope="col">Kategori / Tingkat</th>
                            <th scope="col">Peraih</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prestasis as $item)
                            <tr>
                                <td>
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_prestasi }}"
                                            class="rounded" width="50" height="40" style="object-fit: cover;">
                                    @else
                                        <span class="badge text-bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">
                                    {{ $item->nama_prestasi }}
                                </td>
                                <td>
                                    <span class="badge text-bg-primary">{{ $item->kategori }}</span>
                                    <span class="badge text-bg-info text-dark">{{ $item->tingkat }}</span>
                                </td>
                                <td>{{ $item->nama_peraih }}</td>
                                <td>
                                    <i class="bi bi-calendar-event me-1 text-muted"></i>
                                    {{ $item->tanggal_perolehan->format('d M Y') }}
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.prestasi.edit', $item->id) }}" class="btn btn-light btn-sm"
                                            title="Edit">
                                            <i class="bi bi-pencil-square" aria-hidden="true"
                                                style="color: #fd7e14 !important;"></i>
                                        </a>
                                        <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data prestasi ini?');">
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
                                <td colspan="6" class="text-center text-muted py-3">Tidak ada data prestasi ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($prestasis, 'links'))
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
                    <p class="text-muted small mb-0">
                        Menampilkan {{ $prestasis->firstItem() ?? 0 }} sampai {{ $prestasis->lastItem() ?? 0 }} dari
                        {{ $prestasis->total() }} data
                    </p>
                    <nav aria-label="Navigasi halaman">
                        {{ $prestasis->links() }}
                    </nav>
                </div>
            @endif
        </section>
    </div>
@endsection
