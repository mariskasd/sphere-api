<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'title'                  => ['required'],
            'category'                 => ['required'],
            'description'              => ['required'],
            'latitude'              => ['required'],
            'longitude'              => ['required'],
            'address'              => ['required'],
            // 'image'              => ['image','required'],
        ];
    }

    public function messages()
    {
        return [
            'required'         => ':attribut Wajib Diisi'
        ];
    }
}
