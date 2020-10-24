<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FeatureRequest extends FormRequest
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
        $rules = [
            'title' => 'required|max:255',
            'status' => 'required'
        ];
        if (!empty($this->image)) {
            $rules['image'] = 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:2000';
        }

        return $rules;
    }
}
