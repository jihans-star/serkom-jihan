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
            : 'nullable|file|mimes:mp4,mov,avi,mkv|max:20480',
        ];
    }
}
