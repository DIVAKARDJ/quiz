<?php

namespace App\Http\Requests\Admin;

use App\Model\HomeSlider;
use Illuminate\Foundation\Http\FormRequest;

class CreateHomeSliderRequest extends FormRequest
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
        return HomeSlider::$rules;
    }
}
