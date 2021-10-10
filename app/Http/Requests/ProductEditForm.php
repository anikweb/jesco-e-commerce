<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditForm extends FormRequest
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
            "name" => "required|min:2",
            "category_id" => "required",
            "subcategory_id" => "required",
            "gender" => "required",
            "summary" => "required|max:800|min:20",
            "description" => "required|max:1000|min:50"
        ];
    }
}
