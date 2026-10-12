<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEkstrakurikulerRequest extends FormRequest
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
            'nama_eskul' => ['required', 'string', 'max:40'],
            'pembina' => ['required', 'string', 'max:40'],
            'jadwal_latihan' => ['required', 'string', 'max:40'],
            'deskripsi' => ['required', 'string'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_eskul.required' => 'Nama ekstrakurikuler wajib diisi.',
            'nama_eskul.max' => 'Nama ekstrakurikuler maksimal 40 karakter.',
            'pembina.required' => 'Nama pembina wajib diisi.',
            'pembina.max' => 'Nama pembina maksimal 40 karakter.',
            'jadwal_latihan.required' => 'Jadwal latihan wajib diisi.',
            'jadwal_latihan.max' => 'Jadwal latihan maksimal 40 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'gambar.required' => 'Gambar ekstrakurikuler wajib diunggah.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat JPG, JPEG, PNG, atau WEBP.',
            'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
