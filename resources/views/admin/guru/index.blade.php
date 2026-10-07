@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-mortarboard" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">GURU</h1>
                    <p class="text-muted mb-0">Tinjau data guru SMA NOVA Cendekia</p>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>

                <div class="dropdown-menu dropdown-menu-end p-3" style="min-width:240px;">
                    <label class="form-label small fw-semibold">Mata Pelajaran</label>

                    <select class="form-select form-select-sm" id="filterGuruMapel">
                        <option value="">Semua Mata Pelajaran</option>

                        @foreach ($gurus->pluck('mapel')->unique()->filter() as $mapel)
                            <option value="{{ $mapel }}">{{ $mapel }}</option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-primary btn-sm w-100 mt-3" id="applyGuruFilter">
                        <i class="bi bi-funnel me-1"></i> Terapkan
                    </button>

                    <button type="button" class="btn btn-light btn-sm w-100 mt-2" id="resetGuruFilter">
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
                    <h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Daftar Guru</span>
                    </h2>
                    <p class="text-muted mb-0">Cari, tinjau, dan kelola data guru.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <input class="form-control form-control-sm table-search" type="search" placeholder="Cari..."
                        data-table-search="guruTable" aria-label="Cari guru">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.guru.create') }}"><i class="bi bi-person-plus"
                            aria-hidden="true"></i> Tambah</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="guruTable" data-searchable-table>
                    <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Guru</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Bergabung</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $item)
                            <tr>
                                <td>
                                    @if ($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_guru }}"
                                            class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                    @else
                                        <span class="badge text-bg-secondary">No Photo</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->nama_guru }}
                                </td>
                                <td>
                                    {{ $item->nip }}
                                </td>
                                <td>
                                    <span class="badge text-bg-primary">{{ $item->mapel }}</span>
                                </td>
                                <td>
                                    {{ $item->created_at->format('d M, Y') }}
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.guru.edit', $item->id) }}" class="btn btn-light btn-sm"
                                            title="Lihat / Edit">
                                            <i class="bi bi-pencil-square text-warning" aria-hidden="true"
                                                style="color: #fd7e14 !important;"></i>
                                        </a>

                                        {{-- Form Tombol Hapus --}}
                                        <form action="{{ route('admin.guru.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus data guru ini?');">
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
                                <td colspan="6" class="text-center text-muted py-3">Tidak ada data guru ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
                <p class="text-muted small mb-0">
                    Menampilkan {{ $gurus->firstItem() ?? 0 }} sampai {{ $gurus->lastItem() ?? 0 }} dari
                    {{ $gurus->total() }} data guru
                </p>
                <nav aria-label="Navigasi halaman">
                    {{ $gurus->links() }}
                </nav>
            </div>
        </section>
    </div>
@endsection
