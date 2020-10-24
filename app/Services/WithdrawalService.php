<?php


namespace App\Services;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;

class WithdrawalService {
   
   public $response;
   public function __construct() {
      $this->response = [
         'success' => FALSE
      ];
   }
   
   public function withdrawal(){
      $data['pageTitle'] = __('Withdrawal System');
      $data['all_settings'] = allsetting();
      $data['balance_point'] = PointService::getUserPoints();
      $data['items'] = DB::table('withdrawal_request_by_point')->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
      $this->response = [ 'success' => TRUE, 'data' => $data];
      return $this->response;
   }
   
   public function withdrawalProcess(Request $request){
      $user_id = Auth::user()->id;
      $insert_data = [
         'user_id' => $user_id,
         'point' => $request->amount,
         'equivalent_currency' => $request->amount/allsetting('point_amount_per_unit'),
         'withdrawal_by' => $request->withdrawal_by,
         'paypal_account_id' => $request->paypal_account_id ?? '',
         'bank_name' => $request->bank_name ?? '',
         'bank_account_number' => $request->bank_account_number ?? '',
         'bank_account_name' => $request->bank_account_name ?? '',
         'bank_account_route' => $request->bank_account_route ?? '',
         'created_at' => Carbon::now()
      ];
      
      $user_point = DB::table('user_points')->where('user_id',$user_id)->first();
      $new_points = $user_point->point - $request->amount;
      if($new_points < 0){
         $this->response['message'] = __('Sorry! insufficient points.');
      }else{
         $send_req = DB::table('withdrawal_request_by_point')->insert($insert_data);
         DB::table('user_points')->where('user_id',$user_id)->update(['point'=>$new_points]);
         if ($send_req){
            $this->response = ['success'=>TRUE,'data'=>[],'message'=>__('Withdrawal request sent successfully')];
         }else{
            $this->response = ['success'=>FALSE,'data'=>[],'message'=> __('Withdrawal request sending failed')];
         }
      }
      
      return $this->response;
   }
   
   public function withdrawalHistory(){
      $data = DB::table('withdrawal_request_by_point')->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
      $this->response = [ 'success' => TRUE, 'data' => $data, 'message' => __('Withdrawal history get successfully.')];
      return $this->response;
   }
   
}