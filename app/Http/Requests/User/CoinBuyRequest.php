<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoinBuyRequest extends FormRequest
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
            'coin_id' => 'required|integer|exists:coins,id',
            'payment_id' => 'required|integer|exists:payment_methods,id',
            'amount' => 'required|numeric|min:1|max:9999999',
            'payment_method_nonce' => 'required',
        ];
        
    }
}
