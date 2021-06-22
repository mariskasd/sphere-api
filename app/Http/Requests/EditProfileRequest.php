<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditProfileRequest extends FormRequest
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
            'email'                 => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'phone'              => ['min:10']
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Nama Lengkap Wajib Diisi',
            'email.required'        => 'Email Wajib Diisi',
            'email.email'           => 'Email Tidak Valid',
            'email.unique'          => 'Email Sudah Terdaftar',
            'password.min'          => 'Nomor Telefon Minimal 10 Karakter'
        ];
    }
}
