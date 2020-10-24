<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\WithdrawalRequest;
use App\Services\PointService;
use App\Services\WithdrawalService;
use Illuminate\Http\Request;


class WithdrawalController extends Controller {
   public $service;
   public function __construct() {
      $this->service = new WithdrawalService();
   }
   
   public function withdrawal() {
        $response = $this->service->withdrawal();
        if($response['success'] == TRUE){
           return view('user.withdrawal.withdrawal', $response['data']);
        }else{
           return view('user.withdrawal.withdrawal');
        }
    }
    
    public function withdrawalProcess(WithdrawalRequest $request){
       $service = new WithdrawalService();
       $response = $service->withdrawalProcess($request);
       return redirect()->back()->with($response);
    }
    
}
