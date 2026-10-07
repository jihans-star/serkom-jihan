<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::latest();

        if ($request->filled('gender')) {
            $query->where('jenis_kelamin', $request->gender);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_masuk', $request->tahun);
        }

        $siswas = $query->paginate(10)->withQueryString();
        $tahuns = Siswa::distinct()->pluck('tahun_masuk')->filter();

        return view('admin.siswa.index', compact('siswas','tahuns'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(StoreSiswaRequest $request)
    {
        Siswa::create($request->validated());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function show(Siswa $siswa)
    {
        return view('admin.siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->validated());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);
        $file = $request->file('file');
        $handle = fopen($file->getRealPath(), 'r');

        fgetcsv($handle);
        $succesCount = 0;
        $duplicateCount = 0;

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            if (!empty($row[0])) {
                $exists = Siswa::where('nisn', $row[0])->exists();
                if ($exists) {
                    $duplicateCount++;
                } else {
                    Siswa::create([
                        'nisn'          => $row[0],
                        'nama_siswa'    => $row[1],
                        'jenis_kelamin' => $row[2],
                        'tahun_masuk'   => $row[3],
                    ]);
                    $succesCount++;
                }
            }
        }

        fclose($handle);
        $message = "Berhasil mengimport {$succesCount} data siswa baru.";
        if ($duplicateCount > 0) {
            $message .= " Terdapat {$duplicateCount} data dilewati karena NISN sudah terdaftar.";
        }

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', $message);
    }
}
