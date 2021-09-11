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
            'nama'      => ['required'],
            'nim'       => ['required', 'numeric', 'digits:9', $rules],
            'kelompok'  => ['required', 'digits_between:1,13']
        ];
    }

    public function messages()
    {
        return [
            'nama.required'             => 'Masukkan field nama',
            'nim.required'              => 'Masukkan field nim',
            'nim.numeric'               => 'Masukkan nim dengan angka',
            'nim.digits'                => 'Masukkan NIM 9 karakter',
            'nim.unique'                => 'NIM telah digunakan',
            'kelompok.required'         => 'Masukkan field prodi',
            'kelompok.digits_between'   => 'Masukkan kelompok 1-13'
        ];
    }
}
