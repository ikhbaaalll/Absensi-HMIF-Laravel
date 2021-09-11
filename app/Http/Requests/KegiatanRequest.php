<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KegiatanRequest extends FormRequest
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
            'kegiatan'      => ['required', Rule::in(['Materi', 'Evaluasi', 'Minggu Ceria', 'Lainnya'])],
            'judul'         => ['required', 'string'],
            'tempat'        => ['required', 'string'],
            'waktu'         => ['required', 'date']
        ];
    }
}
