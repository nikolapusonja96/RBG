<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertProduct extends FormRequest
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
            'productName' => 'required|max:30',
            'productPrice' => 'required|max:4',
            'productDescription' => 'required|max:50',
            'productGrams' => 'required|max:4',
            'productImage' => 'required',
            'productCategory' => 'required|',
        ];
    }
}
