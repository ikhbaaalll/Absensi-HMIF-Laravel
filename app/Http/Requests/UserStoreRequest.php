<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->id() == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            '*.required'            => 'Masukkan field :attribute',
            '*.string'              => 'Masukkan field :attribute dengan karakter',
            '*.max'                 => 'Maksimal karakter 255',
            'email.unique'          => 'Email telah digunakan',
            'password.min'          => 'Minimum password 8 karakter',
            'password.confirmed'    => 'Password konfirmasi tidak sesuai'
        ];
    }
}
