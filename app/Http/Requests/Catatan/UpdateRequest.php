<?php

namespace App\Http\Requests\Catatan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public $validator = null;
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
            "judul" => "required",
            "deskripsi" => "required"
        ];
    }

    public function messages(){
        return [
            "judul.required" => "Judul tidak boleh kosong",
            "deskripsi.required" => "Deskripsi tidak boleh kosong"
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $this->validator = $validator;
    }
}

