<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertJob extends FormRequest
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
            'jobName' => 'required|max:70',
            'wage' => 'required|max:6',
            'description' => 'required|max:1000',
            'offer' => 'required|max:1000',
            'requirements' => 'required|max:1000'
        ];
    }
}
