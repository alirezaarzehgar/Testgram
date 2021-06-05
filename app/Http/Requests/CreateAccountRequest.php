<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'website' => 'nullable|string',
            'email' => 'required|email',
            'phone' => 'nullable|string|between:9,12',
            'gender' => 'required|in:male,female,other',
            'bio' => 'nullable|max:70',
            'profile' => 'required|mimes:png,jpg,jpeg',
        ];
    }
}
