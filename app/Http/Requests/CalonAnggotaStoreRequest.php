<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalonAnggotaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'  => ['required'],
            'nim'   => ['required', 'numeric', 'digits_between:8,9'],
            'prodi' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nama.required'         => 'Masukkan field nama',
            'nim.required'          => 'Masukkan field nim',
            'nim.numeric'           => 'Masukkan nim dengan angka',
            'nim.digits_between'    => 'Masukkan NIM 8-9 karakter',
            'prodi.required'        => 'Masukkan field prodi'
        ];
    }
}
