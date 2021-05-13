<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'address1' => 'required|string',
            'address2' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zipCode' => 'required|string|max:20',
            'phoneNo1' => 'required|string|max:20',
            'phoneNo2' => 'string|max:20',
            'user' => 'required|array',
            'user.firstName' => 'required|string|max:50',
            'user.lastName' => 'required|string|max:50',
            'user.email' => 'required|email|unique:users,email|max:150',
            'user.password' => 'required|min:8|max:20',
            'user.passwordConfirmation' => 'same:user.password',
            'user.phone' => 'required|string|max:20',
        ];
    }
}
