<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasicSettingsUpdateForm extends FormRequest
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
            'site_title' => "required|string",
            'logo' => "mimes:png,jpg,svg,webp",
            'icon' => "mimes:png,jpg,svg,webp",
            'tagline' => "required|string",
            'key_words' => "required|string"
        ];
    }
}
