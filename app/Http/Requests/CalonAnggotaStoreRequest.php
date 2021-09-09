<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = $this->method() === "POST" ?
            Rule::unique('calon_anggotas') :
            Rule::unique('calon_anggotas')->ignore($this->calonanggotum->id);

        return [
            'nama'  => ['required'],
            'nim'   => ['required', 'numeric', 'digits_between:8,9', $rules],
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
            'nim.unique'            => 'NIM telah digunakan',
            'prodi.required'        => 'Masukkan field prodi'
        ];
    }
}
