<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\WithdrawalRequest;
use App\Services\WithdrawalService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawalController extends Controller
{
   public function withdrawalProcess(WithdrawalRequest $request){
      $service = new WithdrawalService();
      $response = $service->withdrawalProcess($request);
      return response()->json($response,200);
   }
   
   public function withdrawalHistory(){
      $service = new WithdrawalService();
      $response = $service->withdrawalHistory();
      return response()->json($response,200);
   }
}
