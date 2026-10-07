@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-3 px-lg-4 py-4">
        <div class="page-heading">
            <div class="page-heading-copy">
                <span class="page-icon"><i class="bi bi-controller" aria-hidden="true"></i></span>
                <div>
                    <p class="eyebrow mb-1">Manajemen</p>
                    <h1 class="h3 mb-1">EKSTRAKURIKULER</h1>
                    <p class="text-muted mb-0">Tinjau dan kelola data ekstrakurikuler SMA NOVA Cendekia</p>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>

                <div class="dropdown-menu dropdown-menu-end p-3" style="min-width:240px;">
                    <label class="form-label small fw-semibold">Pembina</label>

                    <select class="form-select form-select-sm" id="filterEkskulPembina">
                        <option value="">Semua Pembina</option>

                        @foreach ($ekstrakurikulers->pluck('pembina')->unique()->filter() as $pembina)
                            <option value="{{ $pembina }}">{{ $pembina }}</option>
                        @endforeach
                    </select>

                    <button type="button" class="btn btn-primary btn-sm w-100 mt-3" id="applyEkskulFilter">
                        <i class="bi bi-funnel me-1"></i> Terapkan
                    </button>

                    <button type="button" class="btn btn-light btn-sm w-100 mt-2" id="resetEkskulFilter">
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
                        <i class="bi bi-table" aria-hidden="true"></i><span>Daftar Ekstrakurikuler</span>
                    </h2>
                    <p class="text-muted mb-0">Cari, tinjau, dan kelola kegiatan ekstrakurikuler.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <input class="form-control form-control-sm table-search" type="search" placeholder="Cari eskul..."
                        data-table-search="eskulTable" aria-label="Cari eskul">
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.ekstrakurikuler.create') }}">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i> Tambah
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="eskulTable" data-searchable-table>
                    <thead>
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Nama Eskul</th>
                            <th scope="col">Pembina</th>
                            <th scope="col">Jadwal Latihan</th>
                            <th scope="col" class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ekstrakurikulers as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_eskul }}"
                                        class="rounded" width="50" height="40" style="object-fit: cover;">
                                </td>
                                <td class="fw-semibold">
                                    {{ $item->nama_eskul }}
                                </td>
                                <td>
                                    <span class="badge text-bg-light border">{{ trim($item->pembina) }}</span>
                                </td>
                                <td>
                                    <i class="bi bi-clock me-1 text-muted"></i> {{ $item->jadwal_latihan }}
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.ekstrakurikuler.edit', $item->id) }}"
                                            class="btn btn-light btn-sm" title="Edit Ekstrakurikuler">
                                            <i class="bi bi-pencil-square" aria-hidden="true"
                                                style="color: #fd7e14 !important;"></i>
                                        </a>

                                        <form action="{{ route('admin.ekstrakurikuler.destroy', $item->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menghapus ekstrakurikuler ini?');">
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
                                <td colspan="5" class="text-center text-muted py-3">Tidak ada data ekstrakurikuler
                                    ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($ekstrakurikulers, 'links'))
                <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
                    <p class="text-muted small mb-0">
                        Menampilkan {{ $ekstrakurikulers->firstItem() ?? 0 }} sampai
                        {{ $ekstrakurikulers->lastItem() ?? 0 }} dari {{ $ekstrakurikulers->total() }} data
                    </p>
                    <nav aria-label="Navigasi halaman">
                        {{ $ekstrakurikulers->links() }}
                    </nav>
                </div>
            @endif
        </section>
    </div>
@endsection
