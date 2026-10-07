<?php

namespace App\Http\Controllers;

use App\Models\Profil_sekolah;
use App\Http\Requests\StoreProfil_sekolahRequest;
use App\Http\Requests\UpdateProfil_sekolahRequest;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['profil'] = Profil_sekolah::first() ?? new Profil_sekolah();
        return view('admin.profil_sekolah.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfil_sekolahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil_sekolah $profil_sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil_sekolah $profil_sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfil_sekolahRequest $request)
    {
        $data = $request->validated();
        $profil = Profil_sekolah::first() ?? new Profil_sekolah();

        if ($request->hasFile('foto')) {
            if ($profil->foto && Storage::exists($profil->foto)) {
                Storage::delete($profil->foto);
            }
            $data['foto'] = $request->file('foto')->store('sekolah/foto', 'public');
        }

        if ($request->hasFile('logo')) {
            if ($profil->logo && Storage::exists($profil->logo)) {
                Storage::delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('sekolah/logo', 'public');
        }

        if ($request->hasFile('foto_kepala_sekolah')) {
            if ($profil->foto_kepala_sekolah && Storage::exists($profil->foto_kepala_sekolah)) {
                Storage::delete($profil->foto_kepala_sekolah);
            }
            $data['foto_kepala_sekolah'] = $request->file('foto_kepala_sekolah')->store('sekolah/kepala_sekolah', 'public');
        }

        $profil->fill($data);
        $profil->save();

        return redirect()
            ->route('admin.sekolah.index')
            ->with('success', 'Profil sekolah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil_sekolah $profil_sekolah)
    {
        //
    }
}
