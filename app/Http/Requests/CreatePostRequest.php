<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'images' => 'required',
            'images.*' => 'mimes:png,jpg,jpeg',
            'title' => 'required|string|max:20',
            'body' => 'required|string|max:70'
        ];
    }
}
