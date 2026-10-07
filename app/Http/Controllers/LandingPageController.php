<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Profil_sekolah;

class LandingPageController extends Controller
{
    public function index()
    {
        $profil = Profil_sekolah::first();
        $jumlahSiswa = Siswa::count();

        $guru = Guru::latest()->take(4)->get();
        $jumlahGuru = Guru::count();

        $jumlahEkstrakurikuler = Ekstrakurikuler::count();
        $ekstrakurikuler = Ekstrakurikuler::latest()->take(4)->get();

        $jumlahPrestasi = Prestasi::count();
        $prestasi = Prestasi::latest()->take(4)->get();
        $galeri = Galeri::latest()->take(4)->get();
        $berita = Berita::where('status', 'Published')
            ->latest()
            ->take(3)
            ->get();
        $jumlahBerita = Berita::where('status', 'Published')->count();

        return view('landing.index', compact(
            'profil',
            'jumlahSiswa',
            'guru',
            'ekstrakurikuler',
            'prestasi',
            'galeri',
            'berita',
            'jumlahEkstrakurikuler',
            'jumlahGuru',
            'jumlahPrestasi',
            'jumlahBerita'
        ));
    }

    public function profil()
    {
        $profil = Profil_sekolah::first();
        return view('landing.profil', compact('profil'));
    }

    public function guru()
    {
        $profil = Profil_sekolah::first();
        $guru = Guru::latest()->get();
        return view('landing.guru.index', compact('profil', 'guru'));
    }

    public function detailGuru($id)
    {
        $profil = Profil_sekolah::first();
        $guru = Guru::findOrFail($id);
        $guruLainnya = Guru::where('id', '!=', $id)
            ->latest()
            ->take(4)
            ->get();
        return view('landing.guru.detail', compact('profil', 'guru', 'guruLainnya'));
    }

    public function ekstrakurikuler()
    {
        $profil = Profil_sekolah::first();
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        return view('landing.ekstrakurikuler.index', compact(
            'profil',
            'ekstrakurikuler'
        ));
    }

    public function detailEkstrakurikuler($id)
    {
        $profil = Profil_sekolah::first();
        $ekstrakurikuler = Ekstrakurikuler::findOrFail($id);
        $ekstrakurikulerLainnya = $ekstrakurikuler::where('id', '!=', $id)
            ->latest()->take(4)->get();
        return view('landing.ekstrakurikuler.detail', compact(
            'profil',
            'ekstrakurikuler',
            'ekstrakurikulerLainnya'
        ));
    }

    public function prestasi()
    {
        $profil = Profil_sekolah::first();
        $prestasi = Prestasi::latest()->get();
        return view('landing.prestasi.index', compact(
            'profil',
            'prestasi'
        ));
    }

    public function detailPrestasi($id)
    {
        $profil = Profil_sekolah::first();
        $prestasi = Prestasi::findOrFail($id);

        $prestasiLainnya = Prestasi::latest()
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('landing.prestasi.detail', compact('profil', 'prestasi','prestasiLainnya'));
    }

    public function galeri()
    {
        $profil = Profil_sekolah::first();
        $galeri = Galeri::latest()->get();
        return view('landing.galeri.index', compact(
            'profil',
            'galeri'
        ));
    }

    public function detailGaleri($id)
    {
        $profil = Profil_sekolah::first();
        $galeri = Galeri::findOrFail($id);

        $galeriLainnya = Galeri::latest()
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('landing.galeri.detail', compact('profil', 'galeri', 'galeriLainnya'));
    }

    public function berita()
    {
        $profil = Profil_sekolah::first();
        $berita = Berita::where('status', 'Published')
            ->latest()
            ->get();

        return view('landing.berita.index', compact(
            'profil',
            'berita'
        ));
    }

    public function detailBerita($slug)
    {
        $profil = Profil_sekolah::first();
        $berita = Berita::where('slug', $slug)
            ->where('status', 'Published')
            ->firstOrFail();

        $beritaLainnya = Berita::where('status', 'Published')
            ->where('slug', '!=', $slug)->latest()->take(4)->get();

        return view('landing.berita.detail_berita', compact('profil', 'berita', 'beritaLainnya'));
    }
}
