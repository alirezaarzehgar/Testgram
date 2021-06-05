<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'nullable|string',
            'website' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|between:9,12',
            'gender' => 'required|in:male,female,other',
            'bio' => 'nullable|max:70',
            'profile' => 'nullable|mimes:png,jpg,jpeg',
        ];
    }
}
