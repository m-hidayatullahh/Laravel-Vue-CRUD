<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WargaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'nama' => 'required|string|max:255',
        'nik' => 'required|string|size:16|unique:wargas,nik',
        'alamat' => 'required|string',
        'ktp_path' => 'image|mimes:jpeg,png,jpg|max:2048',
    ];
}

}
