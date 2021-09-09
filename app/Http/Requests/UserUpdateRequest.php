<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->id() == 1 or auth()->id() == $this->user->id;
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
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'password'  => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            '*.required'            => 'Masukkan field :attribute',
            '*.string'              => 'Masukkan field :attribute dengan karakter',
            'email.unique'          => 'Email telah digunakan',
            '*.max'                 => 'Maksimal karakter 255',
            'password.min'          => 'Minimum password 8 karakter',
            'password.confirmed'    => 'Password konfirmasi tidak sesuai'
        ];
    }
}
