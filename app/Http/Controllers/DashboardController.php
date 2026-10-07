<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Ekstrakurikuler;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Prestasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalBerita = Berita::count();
        $totalEkskul = Ekstrakurikuler::count();
        $totalPrestasi = Prestasi::count();
        $totalGaleri = Galeri::count();
        $totalUser = User::count();

        $dataTerbaru = collect();

        $dataTerbaru = $dataTerbaru->merge(
            Berita::latest('created_at')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->judul ?? 'Berita Tanpa Judul',
                        'detail' => 'Status: ' . ($item->status ?? 'Draft'),
                        'jenis' => 'Berita',
                        'icon' => 'bi-newspaper',
                        'warna' => 'warning',
                        'tanggal' => $item->created_at,
                    ];
                })
        );

        $dataTerbaru = $dataTerbaru->merge(
            Prestasi::latest('created_at')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    $detail = collect([
                        $item->kategori ?? null,
                        $item->tingkat ?? null
                    ])->filter()->implode(' - ');

                    return [
                        'nama' => $item->nama_prestasi ?? 'Prestasi',
                        'detail' => $detail ?: 'Prestasi Sekolah',
                        'jenis' => 'Prestasi',
                        'icon' => 'bi-trophy-fill',
                        'warna' => 'danger',
                        'tanggal' => $item->created_at,
                    ];
                })
        );

        $dataTerbaru = $dataTerbaru->merge(
            Ekstrakurikuler::latest('created_at')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_eskul ?? 'Ekstrakurikuler',
                        'detail' => 'Pembina: ' . ($item->pembina ?? '-'),
                        'jenis' => 'Ekstrakurikuler',
                        'icon' => 'bi-people-fill',
                        'warna' => 'primary',
                        'tanggal' => $item->created_at,
                    ];
                })
        );

        $dataTerbaru = $dataTerbaru->merge(
            Guru::latest('created_at')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    $nip = $item->nip ? "NIP: {$item->nip}" : 'Tenaga Pendidik';
                    return [
                        'nama' => $item->nama_guru ?? 'Guru',
                        'detail' => $nip,
                        'jenis' => 'Guru',
                        'icon' => 'bi-person-workspace',
                        'warna' => 'success',
                        'tanggal' => $item->created_at,
                    ];
                })
        );

        $dataTerbaru = $dataTerbaru->merge(
            Siswa::latest('created_at')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    $nisn = $item->nisn ? "NISN: {$item->nisn}" : 'Siswa Sekolah';
                    return [
                        'nama' => $item->nama_siswa ?? 'Siswa',
                        'detail' => $nisn,
                        'jenis' => 'Siswa',
                        'icon' => 'bi-mortarboard-fill',
                        'warna' => 'info',
                        'tanggal' => $item->created_at,
                    ];
                })
        );

        $dataTerbaru = $dataTerbaru->merge(
            Galeri::latest('created_at')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->judul ?? 'Galeri Foto',
                        'detail' => 'Kategori: ' . ($item->kategori ?? 'Foto'),
                        'jenis' => 'Galeri',
                        'icon' => 'bi-images',
                        'warna' => 'secondary',
                        'tanggal' => $item->created_at,
                    ];
                })
        );

        $dataTerbaru = $dataTerbaru->merge(
            User::latest('created_at')
                ->limit(5)
                ->get()
                ->map(function ($item) {
                    $role = $item->role ? "Role: {$item->role}" : 'Akun Sistem';
                    return [
                        'nama' => $item->name ?? 'Pengguna',
                        'detail' => $role,
                        'jenis' => 'Pengguna',
                        'icon' => 'bi-person-fill',
                        'warna' => 'dark',
                        'tanggal' => $item->created_at,
                    ];
                })
        );

        $dataTerbaru = $dataTerbaru
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();

        return view('admin.index', compact(
            'totalSiswa',
            'totalGuru',
            'totalBerita',
            'totalEkskul',
            'totalPrestasi',
            'totalGaleri',
            'totalUser',
            'dataTerbaru'
        ));
    }
}
