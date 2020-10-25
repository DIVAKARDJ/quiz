<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class BookCategorySaveRequest extends FormRequest
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
            'name' => ['required', Rule::unique('book_categories', 'name')],
            'status' => 'required',
            'image' => 'mimes:jpeg,jpg,JPG,png,PNG,gif|max:5000'
        ];
        if (!empty($this->edit_id)) {
            $rules['name'] = ['required', Rule::unique('book_categories', 'name')->ignore($this->edit_id, 'id')];
            $rules['edit_id'] = '';
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => __('Book Category Name field can not be empty'),
            'status.required' => __('Status field can not be empty'),
            'image.required' => __('Image is required'),
        ];

        return $messages;
    }
}
