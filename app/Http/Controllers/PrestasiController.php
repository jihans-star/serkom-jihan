<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Http\Requests\StorePrestasiRequest;
use App\Http\Requests\UpdatePrestasiRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasis = Prestasi::latest()->paginate(10);
        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create()
    {
        return view('admin.prestasi.create');
    }

    public function store(StorePrestasiRequest $request)
    {
        $gambarPath = null;
        $slug = Str::slug($request->nama_prestasi);
        $request->merge(['slug' => $slug]);
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('prestasi', 'public');
        }

        Prestasi::create([
            'nama_prestasi' => $request->nama_prestasi,
            'slug' => $slug,
            'kategori' => $request->kategori,
            'tingkat' => $request->tingkat,
            'nama_peraih' => $request->nama_peraih,
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(UpdatePrestasiRequest $request, Prestasi $prestasi)
    {
        $gambarPath = $prestasi->gambar;
        if ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('prestasi', 'public');
        }

        $prestasi->update([
            'nama_prestasi' => $request->nama_prestasi,
            'slug' => Str::slug($request->nama_prestasi),
            'kategori' => $request->kategori,
            'tingkat' => $request->tingkat,
            'nama_peraih' => $request->nama_peraih,
            'tanggal_perolehan' => $request->tanggal_perolehan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
            Storage::disk('public')->delete($prestasi->gambar);
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil dihapus.');
    }
}
