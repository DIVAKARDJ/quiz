<?php

namespace App\Http\Requests\Admin;

use App\Model\Admin\Book;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
        $rules = Book::$rules;
        $rules['name'] = $rules['name'].",name,".$this->route("book");
        $rules['book_pdf'] = 'mimes:pdf|max:10000';

        return $rules;
    }
}
