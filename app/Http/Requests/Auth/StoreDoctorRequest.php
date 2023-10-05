<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorsRequest extends FormRequest
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
            "email" => 'required|email|unique:doctors,email,' . $this->id,
            "password" => 'required|sometimes',
            "phone" => 'required|numeric|unique:doctors,phone,' . $this->id,
            "name" => 'required|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            "appointments" => 'required',
            "section_id" => 'required',
        ];
    }



}
