@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-newspaper" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">BERITA</h1>
                    <p class="text-muted mb-0">Tinjau dan kelola berita SMA NOVA Cendekia</p>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>

                <div class="dropdown-menu dropdown-menu-end p-3" style="min-width:220px;">
                    <label class="form-label small fw-semibold">Status</label>

                    <select class="form-select form-select-sm" id="filterBeritaStatus">
                        <option value="">Semua Status</option>
                        <option value="Draft">Draft</option>
                        <option value="Published">Published</option>
                    </select>

                    <label class="form-label small fw-semibold">Tanggal</label>

                    <select class="form-select form-select-sm" id="filterBeritaTanggal">
                        <option value="">Semua Tanggal</option>
                        @foreach ($beritas->pluck('tanggal')->unique()->filter() as $tanggal)
                            <option value="{{ \Carbon\Carbon::parse($tanggal)->format('d M, Y') }}">
                                {{ \Carbon\Carbon::parse($tanggal)->format('d M, Y') }}
                            </option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-primary btn-sm w-100 mt-3" id="applyBeritaFilter">
                        <i class="bi bi-funnel me-1"></i> Terapkan
                    </button>

                    <button type="button" class="btn btn-light btn-sm w-100 mt-2" id="resetBeritaFilter">
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
                        <i class="bi bi-table" aria-hidden="true"></i><span>Daftar Berita</span>
                    </h2>
                    <p class="text-muted mb-0">Cari, tinjau, dan kelola postingan berita.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <input class="form-control form-control-sm table-search" type="search" placeholder="Cari berita..."
                        data-table-search="beritaTable" aria-label="Cari berita">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.berita.create') }}">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="beritaTable" data-searchable-table>
                    <thead>
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Judul Berita</th>
                            <th scope="col">Tanggal</th>
                            <th>Slug</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($beritas as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                        class="rounded" width="50" height="40" style="object-fit: cover;">
                                </td>
                                <td class="fw-semibold">
                                    {{ $item->judul }}
                                </td>
                                <td>
                                    {{($item->tanggal)->format('d M, Y') }}
                                </td>
                                <td>
                                    {{ $item->slug }}</td>
                                <td>
                                    <span class="badge text-bg-light border">{{ $item->user->name ?? 'Admin' }}</span>
                                </td>
                                <td>
                                    @if ($item->status === 'Published')
                                        <span class="badge text-bg-success">
                                            <i class="bi bi-globe me-1"></i> Published
                                        </span>
                                    @else
                                        <span class="badge text-bg-secondary">
                                            <i class="bi bi-lock-fill me-1"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-light btn-sm"
                                            title="Edit Berita">
                                            <i class="bi bi-pencil-square" aria-hidden="true"
                                                style="color: #fd7e14 !important;"></i>
                                        </a>

                                        <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus berita ini?');">
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
                                <td colspan="5" class="text-center text-muted py-3">Tidak ada data berita ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($beritas, 'links'))
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
                    <p class="text-muted small mb-0">
                        Menampilkan {{ $beritas->firstItem() ?? 0 }} sampai {{ $beritas->lastItem() ?? 0 }} dari
                        {{ $beritas->total() }} berita
                    </p>
                    <nav aria-label="Navigasi halaman">
                        {{ $beritas->links() }}
                    </nav>
                </div>
            @endif
        </section>
    </div>
@endsection
