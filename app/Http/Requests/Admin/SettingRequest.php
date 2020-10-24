<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $rules['app_title'] = 'required|max:255';
        if (isset($this->logo)) {
            $rules['logo']='required|image|mimes:jpg,jpeg,png|max:3000';
        }
        if (isset($this->favicon)) {
            $rules['favicon']='required|image|mimes:jpg,jpeg,png|max:3000';
        }
        if (isset($this->login_logo)) {
            $rules['login_logo']='required|image|mimes:jpg,jpeg,png|max:3000';
        }
        if (isset($this->fifty_fifty_answer)) {
            $rules['fifty_fifty_answer']='integer|numeric|min:0|max:999999';
        }
        if (isset($this->hints_coin)) {
            $rules['hints_coin']='integer|numeric|min:0|max:999999';
        }
        if (isset($this->admob_coin)) {
            $rules['admob_coin']='integer|numeric|min:0|max:999999';
        }
        if (isset($this->signup_coin)) {
            $rules['signup_coin']='integer|numeric|min:0|max:999999';
        }

        return $rules;
    }
}
