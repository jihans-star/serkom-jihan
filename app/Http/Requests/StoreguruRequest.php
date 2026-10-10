<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreguruRequest extends FormRequest
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
            'nama_guru' => 'required|string|max:40',
            'nip'       => 'required|string|max:15|unique:gurus,nip',
            'mapel'     => 'required|string|max:40',
            'foto'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
        'nama_guru.required' => 'Nama guru wajib diisi.',
        'nip.required' => 'NIP wajib diisi.',
        'nip.unique' => 'NIP sudah terdaftar. Gunakan NIP lain.',
        'mapel.required' => 'Mata pelajaran wajib diisi.',
        'foto.image' => 'File harus berupa gambar.',
        'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
        'foto.max' => 'Ukuran foto maksimal 2 MB.',
    ];
    }
}
