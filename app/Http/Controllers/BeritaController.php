<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Http\Requests\UpdateBeritaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $data['beritas'] = Berita::with('user')->latest()->get();
        return view('admin.berita.index', $data);
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->judul);
        $request->merge(['slug' => $slug]);

        $request->validate([
            'judul' => 'required|string|max:50|unique:beritas,judul',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'  => 'required|in:Draft,Published',
            'slug' => 'required|unique:beritas,slug'
        ],[
            'judul.unique' => 'Judul berita sudah digunakan. Silakan gunakan judul yang berbeda.',
            'judul.required' => 'Judul berita harus diisi.',
            'judul.max' => 'Judul berita tidak boleh lebih dari 50 karakter.',
            'isi.required' => 'Isi berita harus diisi.',
            'tanggal.required' => 'Tanggal berita harus diisi.',
            'gambar.required'  => 'Gambar berita wajib diunggah.',
            'tanggal.date' => 'Tanggal berita harus berupa tanggal yang valid.',
            'gambar.image' => 'Gambar harus berupa file gambar.',
            'gambar.mimes' => 'Gambar harus berupa file dengan format: jpeg, png, jpg, gif, svg.',
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'slug.unique' => 'Slug berita sudah digunakan. Silakan gunakan judul yang berbeda.'
        ]);

        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $file->store('berita');
        } else {
            $filename = null;
        }

        Berita::create([
            'judul' => $request->judul,
            'slug' => $slug,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $filename,
            'status'  => $request->status,
            'id_user' => auth()->id,
        ]);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    public function show(Berita $berita)
    {

    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            if ($berita->gambar && Storage::exists($berita->gambar)) {
                Storage::delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->gambar && Storage::exists($berita->gambar)) {
            Storage::delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus');
    }
}
