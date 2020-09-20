<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRegistration extends FormRequest
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
            'restaurantName' => 'required',
            'description' => 'required',
            'mail' => 'required|email|unique:restaurants,email|max:70',
            'password' => 'required',
            'locationRestaurant' => 'required',
            'chbProducts' => 'required',
            'deliveryCost' => 'required',
            'deliveryMinimum' => 'required',
            'deliveryTime' => 'required',
            'kitchen' => 'required',
            'picture' => 'required' //image ako ne radi mimes
        ];
    }
}
