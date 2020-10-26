<?php

namespace App\Http\Requests\Admin;

use App\Model\OldPaper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOldPaperRequest extends FormRequest
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
        $rules = OldPaper::$rules;
        $rules['name'] = $rules['name'].",name,".$this->route("oldPaper");
        $rules['paper_pdf'] = 'mimes:pdf|max:10000';

        return $rules;
    }
}
