<?php

namespace App\Http\Requests\Admin;

use App\Model\PaperCategory;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePaperCategoryRequest extends FormRequest
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
        $rules = PaperCategory::$rules;
        $rules['name'] = $rules['name'].",name,".$this->route("paperCategory");

        return $rules;
    }
}
