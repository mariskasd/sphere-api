<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPasswordRequest extends FormRequest
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
            'password_old'                  => ['required'],
            'password'              => ['required', 'min:8', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'password_old.required'         => 'Kata Sandi Lama Wajib Diisi',
            'password.required'     => 'Kata Sandi Baru Wajib Diisi',
            'password.min'          => 'Kata Sandi Baru Minimal 8 Karakter',
            'password.confirmed'    => 'Kata Sandi Baru Tidak Sama Dengan Konfirmasi Kata Sandi'
        ];
    }
}
