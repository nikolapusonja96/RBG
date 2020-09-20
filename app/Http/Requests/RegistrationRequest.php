<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'firstName' => 'required|regex:/^[A-zČčĐđĆćŠš]{3,11}$/',
            'lastName' => 'required|regex:/^[A-zČčĐđĆćŠš]{3,11}$/',
            'address' => 'required',
//            'gender' => 'required',
            'mail' => 'required|email|unique:users,mail|max:70',
            'password' => 'required'
        ];
    }
}
