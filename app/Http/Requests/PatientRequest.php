<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_pasien' => ['required'],
            'NIK' => ['required'],
            'alamat_lengkap' => ['nullable'],
            'no_tlp' => ['nullable'],
            'umur' => ['nullable'],
            'keluhan' => ['nullable'],
            'tgl_daftar' => ['required']
        ];
    }
}
