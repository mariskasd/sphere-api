<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiverHeightRequest extends FormRequest
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
            'river_id'                  => ['required'],
            'height'                 => ['required'],
            'status'              => ['required'],
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
