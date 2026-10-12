<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGaleriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'      => 'required|string|max:50',
            'keterangan' => 'required|string',
            'kategori'   => 'required|in:Foto,Video',
            'tanggal'    => 'required|date',
            'file'       => $this->kategori === 'Foto'
                ? 'required|image|mimes:jpeg,png,jpg,webp|max:5048'
                : 'required|file|mimes:mp4,mov,avi,mkv|max:2480',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul galeri wajib diisi.',
            'keterangan.required' => 'Keterangan galeri wajib diisi.',
            'kategori.required' => 'Kategori galeri wajib dipilih.',
            'tanggal.required' => 'Tanggal galeri wajib diisi.',
            'file.required' => 'File wajib diunggah.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format file tidak sesuai dengan kategori.',
            'file.max' => 'Ukuran file terlalu besar. Maksimal gambar 5 MB dan video 2,4 MB.',
        ];
    }
}
