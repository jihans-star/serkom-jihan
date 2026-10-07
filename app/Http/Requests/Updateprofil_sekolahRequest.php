<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfil_sekolahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'npsp' => 'required|string|max:10',
            'tahun_berdiri' => 'required|digits:4',
            'kontak' => 'required|string|max:15',
            'alamat' => 'required|string',
            'visi_misi' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kepala_sekolah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
