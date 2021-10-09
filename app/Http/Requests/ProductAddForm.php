<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddForm extends FormRequest
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
            "name" => "required|unique:products,name|min:2",
            "category_id" => "required",
            "subcategory_id" => "required",
            "thumbnail" => "required|mimes:png,jpg,svg,webp jpeg",
            "gender" => "required",
            "summary" => "required|max:400|min:50",
            "description" => "required|max:800|min:50",
            "image_galleries[]" => "required|mimes:png,jpg,svg,webp jpeg",
            "rPrice[]" => "required|integer",
            "quantities[]" => "required|integer",
        ];
    }
}
