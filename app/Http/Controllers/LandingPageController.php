<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Ekstrakurikuler;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Profil_sekolah;
use Illuminate\Http\Request;


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
            ->where('mapel', $guru->mapel)
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

    public function detailEkstrakurikuler($slug)
    {
        $profil = Profil_sekolah::first();
        $ekstrakurikuler = Ekstrakurikuler::where('slug',$slug)->firstOrFail();
        $ekstrakurikulerLainnya = Ekstrakurikuler::where('slug', '!=', $slug)
            ->latest()
            ->take(4)
            ->get();           ;
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

    public function detailPrestasi($slug)
    {
        $profil = Profil_sekolah::first();
        $prestasi = Prestasi::where('slug',$slug)->firstOrFail();

        $prestasiLainnya = Prestasi::latest()
            ->where('slug', '!=', $slug)
            ->take(4)
            ->get();

        return view('landing.prestasi.detail', compact('profil', 'prestasi', 'prestasiLainnya'));
    }

    public function galeri()
    {
        $profil = Profil_sekolah::first();
        $galeriFoto = Galeri::where('kategori', 'Foto')
            ->latest()
            ->get();

        $galeriVideo = Galeri::where('kategori', 'Video')
            ->latest()
            ->get();

        return view('landing.galeri.index', compact('profil','galeriFoto','galeriVideo'));
    }

    public function detailGaleri($id)
    {
        $profil = Profil_sekolah::first();
        $galeri = Galeri::findOrFail($id);

        $galeriLainnya = Galeri::latest()
            ->where('kategori',$galeri->kategori)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();

        return view('landing.galeri.detail', compact('profil', 'galeri', 'galeriLainnya'));
    }

    public function berita(Request $request)
    {
        $profil = Profil_sekolah::first();
        if(isset($_GET['search'])){
            $berita = Berita::where('status', 'Published')
            ->where('judul','like', '%'.$_GET['search'] . '%')
            ->latest()
            ->get();
        }else{
            $berita = Berita::where('status', 'Published')
                ->latest()
                ->get();
        }

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
