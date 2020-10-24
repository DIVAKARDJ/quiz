<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
          'name' => 'required|max:255',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:8|confirmed',
          'password_confirmation' => 'required',
       ];
   
       if ($this->phone) {
          $rules['phone'] = 'numeric|phone_number';
       }
       return $rules;
       
    }
    
    public function messages() {
       $messages = [
          'name.required' => __('Name field can not be empty'),
          'password.required' => __('Password field can not be empty'),
          'password_confirmation.required' => __('Password confirmed field can not be empty'),
          'password.min' => __('Password length must be above 8 characters.'),
          'email.required' => __('Email field can not be empty'),
          'email.unique' => __('Email Address already exists'),
          'email.email' => __('Invalid email address'),
          'phone.phone_number' => __('Invalid Phone Number'),
       ];
       return $messages;
    }
}
