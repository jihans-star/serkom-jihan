<?php

namespace App\Http\Controllers;

use App\Models\Profil_sekolah;
use App\Http\Requests\StoreProfil_sekolahRequest;
use App\Http\Requests\UpdateProfil_sekolahRequest;

class ProfilSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.profile');
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
    public function update(UpdateProfil_sekolahRequest $request, Profil_sekolah $profil_sekolah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil_sekolah $profil_sekolah)
    {
        //
    }
}
