<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WithdrawalRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
       $points = DB::table('user_points')->where('user_id',Auth::user()->id)->first();
       $min_points = allsetting('minimum_point_to_withdrawal') ?? 0;
       $rules = [
          'amount' => 'required|numeric|min:'.$min_points.'|max:'.$points->point,
       ];
        return $rules;
    }

    public function messages() {
        $message = [
            'amount.min'=>__('Minimum withdrawal point is '.allsetting('minimum_point_to_withdrawal') ?? '0'.'!'),
            'amount.max'=>__('Insufficient withdrawal points!')
        ];
        
        return $message;
    }
   
   protected function failedValidation(Validator $validator)
   {
      if ($this->header('accept') == "application/json") {
         $errors = [];
         if ($validator->fails()) {
            $e = $validator->errors()->all();
            foreach ($e as $error) {
               $errors[] = $error;
            }
         }
         $json = ['success'=>false,
                  'data'=>[],
                  'message' => $errors[0],
         ];
         $response = new JsonResponse($json, 200);
         
         throw (new ValidationException($validator, $response))->errorBag($this->errorBag)->redirectTo($this->getRedirectUrl());
      } else {
         throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
      }
      
   }
}
