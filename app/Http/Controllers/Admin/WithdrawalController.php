<?php


namespace App\Http\Controllers\Admin;


use App\Services\Admin\WithdrawalService;

class WithdrawalController {
   public $service;
   public function __construct() {
      $this->service = new WithdrawalService();
   }
   
   public function withdrawalList(){
      $response = $this->service->withdrawalList();
      return view('admin.withdrawal.list',$response['data']);
   }
   
   public function withdrawalDetails($id){
      $response = $this->service->withdrawalDetails($id);
      return $response;
   }
   
   public function withdrawalApprove($id) {
      $response = $this->service->withdrawalApprove($id);
      return response()->json($response);
   }
   
   public function withdrawalDecline($id){
      $response = $this->service->withdrawalDecline($id);
      return response()->json($response);
   }
   public function withdraw($id){
      $response = $this->service->withdraw($id);
      return response()->json($response);
   }
   
}