<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebSettingRequest extends FormRequest
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
        $rules=[];
        if (isset($this->landing_banner_image)) {
            $rules['landing_banner_image']='required|image|mimes:jpg,jpeg,png|max:3000';
        }
        if (isset($this->landing_about_image)) {
            $rules['landing_about_image']='required|image|mimes:jpg,jpeg,png|max:3000';
        }
        if (isset($this->landing_download_image)) {
            $rules['landing_download_image']='required|image|mimes:jpg,jpeg,png|max:3000';
        }

        return $rules;
    }
}
