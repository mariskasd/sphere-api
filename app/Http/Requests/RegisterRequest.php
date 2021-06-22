<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'                  => ['required'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'min:8', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Nama Lengkap Wajib Diisi',
            'email.required'        => 'Email Wajib Diisi',
            'email.email'           => 'Email Tidak Valid',
            'email.unique'          => 'Email Sudah Terdaftar',
            'password.required'     => 'Kata Sandi Wajib Diisi',
            'password.min'          => 'Kata Sandi Minimal 8 Karakter',
            'password.confirmed'    => 'Kata Sandi Tidak Sama Dengan Konfirmasi Kata Sandi'
        ];
    }
}
