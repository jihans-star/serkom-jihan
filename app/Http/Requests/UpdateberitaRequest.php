<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateberitaRequest extends FormRequest
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
            'judul'   => 'required|string|max:50',
            'isi'     => 'required|string',
            'tanggal' => 'required|date',
            'gambar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status'  => 'required|in:Draft,Published',
        ];
    }

    public function messages(): array
{
    return [
        'judul.required' => 'Judul berita wajib diisi.',
        'judul.max' => 'Judul berita maksimal 50 karakter.',
        'isi.required' => 'Isi berita wajib diisi.',
        'tanggal.required' => 'Tanggal berita wajib diisi.',
        'tanggal.date' => 'Tanggal berita harus berupa tanggal yang valid.',
        'gambar.image' => 'File harus berupa gambar.',
        'gambar.mimes' => 'Gambar harus berformat JPEG, JPG, PNG, GIF, atau WEBP.',
        'gambar.max' => 'Ukuran gambar maksimal 2 MB.',
        'status.required' => 'Status berita wajib dipilih.',
        'status.in' => 'Status berita harus Draft atau Published.',
    ];
}
}
