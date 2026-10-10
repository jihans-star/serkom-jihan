<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGaleriRequest extends FormRequest
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
                ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:5048'
                : 'nullable|file|mimes:mp4,mov,avi,mkv|max:50480',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul galeri wajib diisi.',
            'judul.string' => 'Judul galeri harus berupa teks.',
            'judul.max' => 'Judul galeri maksimal 50 karakter.',
            'keterangan.required' => 'Keterangan galeri wajib diisi.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'kategori.required' => 'Kategori galeri wajib dipilih.',
            'kategori.in' => 'Kategori harus berupa Foto atau Video.',
            'tanggal.required' => 'Tanggal galeri wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
            'file.image' => 'File yang diunggah harus berupa gambar.',
            'file.mimes' => 'Format file tidak sesuai dengan kategori yang dipilih.',
            'file.max' => 'Ukuran file terlalu besar. Maksimal 5 MB untuk foto dan 50 MB untuk video.',
        ];
    }
}
