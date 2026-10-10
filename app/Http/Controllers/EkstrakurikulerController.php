<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEkstrakurikulerRequest;
use App\Http\Requests\UpdateEkstrakurikulerRequest;
use Illuminate\Support\Str;


class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ekstrakurikulers['ekstrakurikulers'] = Ekstrakurikuler::latest()->paginate(10);
        return view('admin.ekstrakurikuler.index', $ekstrakurikulers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ekstrakurikuler.create');
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEkstrakurikulerRequest $request)
    {
        $slug = Str::slug($request->nama_eskul);
        $request->merge(['slug' => $slug]);
        $gambarPath = $request->file('gambar')->store('ekstrakurikuler');

        Ekstrakurikuler::create([
            'nama_eskul' => $request->nama_eskul,
            'slug' => $slug,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }

   /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('admin.ekstrakurikuler.edit', compact('ekstrakurikuler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEkstrakurikulerRequest $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $gambarPath = $ekstrakurikuler->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::exists($gambarPath)) {
                Storage::delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('ekstrakurikuler');
        }

        $ekstrakurikuler->update([
            'nama_eskul' => $request->nama_eskul,
            'slug' => Str::slug($request->nama_eskul),
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        if ($ekstrakurikuler->gambar && Storage::exists($ekstrakurikuler->gambar)) {
            Storage::delete($ekstrakurikuler->gambar);
        }

        $ekstrakurikuler->delete();

        return redirect()->route('admin.ekstrakurikuler.index')->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }
}
