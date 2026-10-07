<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateGaleriRequest;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $galeris['galeris'] = Galeri::latest()->paginate(10);
        return view('admin.galeri.index', $galeris);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGaleriRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $folder = $request->kategori === 'Foto' ? 'galeri/foto' : 'galeri/video';
            $file = $request->file('file');

            $data['file'] = $file->store($folder);
            $data['mime_type'] = $file->getMimeType();
        }

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        //
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGaleriRequest $request, Galeri $galeri)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($galeri->file && Storage::exists($galeri->file)) {
                Storage::delete($galeri->file);
            }

            $folder = $request->kategori === 'Foto' ? 'galeri/foto' : 'galeri/video';
            $file = $request->file('file');

            $data['file'] = $file->store($folder);
            $data['mime_type'] = $file->getMimeType();
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        //
        if ($galeri->file && Storage::exists($galeri->file)) {
            Storage::delete($galeri->file);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus');
    }
}
