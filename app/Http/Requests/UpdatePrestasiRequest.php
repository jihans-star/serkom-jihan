<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePrestasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_prestasi' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'string', 'max:40'],
            'tingkat' => ['required', 'string', 'max:40'],
            'nama_peraih' => ['required', 'string', 'max:100'],
            'tanggal_perolehan' => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_prestasi.required' => 'Nama prestasi wajib diisi.',
            'nama_prestasi.max' => 'Nama prestasi maksimal 100 karakter.',
            'kategori.required' => 'Kategori prestasi wajib dipilih.',
            'kategori.max' => 'Kategori maksimal 40 karakter.',
            'tingkat.required' => 'Tingkat prestasi wajib dipilih.',
            'tingkat.max' => 'Tingkat prestasi maksimal 40 karakter.',
            'nama_peraih.required' => 'Nama peraih prestasi wajib diisi.',
            'nama_peraih.max' => 'Nama peraih maksimal 100 karakter.',
            'tanggal_perolehan.required' => 'Tanggal perolehan prestasi wajib diisi.',
            'tanggal_perolehan.date' => 'Tanggal perolehan harus berupa tanggal yang valid.',
            'deskripsi.required' => 'Deskripsi prestasi wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
