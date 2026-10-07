@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-images" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">GALERI</h1>
                    <p class="text-muted mb-0">Tinjau dan kelola galeri foto & video SMA NOVA Cendekia</p>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>

                <div class="dropdown-menu dropdown-menu-end p-3" style="min-width:220px;">
                    <label class="form-label small fw-semibold">Kategori</label>

                    <select class="form-select form-select-sm" id="filterGaleriKategori">
                        <option value="">Semua Kategori</option>
                        <option value="Foto">Foto</option>
                        <option value="Video">Video</option>
                    </select>

                    <button type="button" class="btn btn-primary btn-sm w-100 mt-3" id="applyGaleriFilter">
                        <i class="bi bi-funnel me-1"></i> Terapkan
                    </button>

                    <button type="button" class="btn btn-light btn-sm w-100 mt-2" id="resetGaleriFilter">
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
                        <i class="bi bi-table" aria-hidden="true"></i><span>Daftar Galeri</span>
                    </h2>
                    <p class="text-muted mb-0">Cari, tinjau, dan kelola item galeri.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <input class="form-control form-control-sm table-search" type="search" placeholder="Cari galeri..."
                        data-table-search="galeriTable" aria-label="Cari galeri">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.galeri.create') }}">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="galeriTable" data-searchable-table>
                    <thead>
                        <tr>
                            <th scope="col">File</th>
                            <th scope="col">Judul Galeri</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($galeris as $item)
                            <tr>
                                <td>
                                    @if ($item->kategori === 'Foto')
                                        <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->judul }}"
                                            class="rounded" width="50" height="40" style="object-fit: cover;">
                                    @else
                                        <span class="badge text-bg-dark"><i class="bi bi-film me-1"></i> Video</span>
                                    @endif
                                </td>
                                <td class="fw-semibold">
                                    {{ $item->judul }}
                                </td>
                                <td>
                                    @if ($item->kategori === 'Foto')
                                        <span class="badge text-bg-info">
                                            <i class="bi bi-image me-1"></i> Foto
                                        </span>
                                    @else
                                        <span class="badge text-bg-warning">
                                            <i class="bi bi-camera-video me-1"></i> Video
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M, Y') }}
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-light btn-sm"
                                            title="Edit Galeri">
                                            <i class="bi bi-pencil-square" aria-hidden="true"
                                                style="color: #fd7e14 !important;"></i>
                                        </a>

                                        <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus galeri ini?');">
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
                                <td colspan="5" class="text-center text-muted py-3">Tidak ada data galeri ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($galeris, 'links'))
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
                    <p class="text-muted small mb-0">
                        Menampilkan {{ $galeris->firstItem() ?? 0 }} sampai {{ $galeris->lastItem() ?? 0 }} dari
                        {{ $galeris->total() }} galeri
                    </p>
                    <nav aria-label="Navigasi halaman">
                        {{ $galeris->links() }}
                    </nav>
                </div>
            @endif
        </section>
    </div>
@endsection
