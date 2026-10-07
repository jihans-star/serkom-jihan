<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //
        $siswaId = $this->route('siswa')->id ?? $this->route('siswa');

        return [
            'nisn'          => ['required', 'string', 'max:10', 'unique:siswas,nisn,' . $siswaId],
            'nama_siswa'    => ['required', 'string', 'max:40'],
            'jenis_kelamin' => ['required', 'in:Perempuan,Laki-laki'],
            'tahun_masuk'   => ['required', 'digits:4'],
        ];
    }

    /**
     * Custom pesan error (opsional)
     */
    public function messages(): array
    {
        return [
            'nisn.unique' => 'NISN ini sudah digunakan oleh siswa lain.',
            'digits'      => 'Format tahun masuk harus 4 digit angka.',
        ];
    }
}
