<?php


namespace App\Services\Admin;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WithdrawalService {
   
   public $response;
   public function __construct() {
      $this->response = ['success'=>FALSE,'data'=>[],'message'=>''];
   }
   
   public function withdrawalList(){
      $data['pageTitle'] = __('Withdrawal List');
      $data['menu'] = 'userlist';
      $data['withdrawalLists'] = DB::table('withdrawal_request_by_point')
         ->leftJoin('users','withdrawal_request_by_point.user_id','=','users.id')
         ->select('withdrawal_request_by_point.*','users.name')
         ->orderby('created_at','desc')->paginate(15);
      if ($data['withdrawalLists']){
         $this->response = ['success'=>TRUE,'data'=>$data];
      }
      return $this->response;
   }
   
   public function withdrawalDetails($id){
      $data['withdrawal_details'] = DB::table('withdrawal_request_by_point')
        ->leftJoin('users','withdrawal_request_by_point.user_id','=','users.id')
        ->select('withdrawal_request_by_point.*','users.name')
        ->where('withdrawal_request_by_point.id','=',$id)
        ->first();
      
      return view('admin.withdrawal.withdrawal_details',$data);
   }
   
   public function withdrawalApprove($id){
      $approved = DB::table('withdrawal_request_by_point')->where('id',$id)->update(['status'=>'Approved','updated_at'=>Carbon::now()]);
      if ($approved){
         $this->response = ['success'=>TRUE,'message'=>__('Withdrawal request approved successfully.')];
      }else{
         $this->response['message'] = __('Withdrawal request approved failed');
      }
      return $this->response;
   }
   
   public function withdrawalDecline($id){
      
      DB::beginTransaction();
      try {
         $declined = DB::table('withdrawal_request_by_point')->where('id','=',$id)->update(['status'=>'Declined']);
         if($declined){
            $withdrawal_request = DB::table('withdrawal_request_by_point')->where('id',$id)->first();
            $user_id = $withdrawal_request->user_id;
            $user_points = DB::table('user_points')->where('user_id',$user_id)->first()->point;
            $new_points = $user_points + $withdrawal_request->point;
            DB::table('user_points')->where('user_id',$user_id)->update(['point'=>$new_points]);
            $this->response = ['success'=>TRUE,'message'=>__('Withdrawal request declined.')];
           DB::commit();
         }else{
            $this->response['message'] = __('Withdrawal request declined failed.');
         }
      }catch (\Exception $exception){
         $this->response['message'] = __('Something went wrong!');
         DB::rollback();
      }

      return $this->response;
   }
   
   public function withdraw($id){
      
      DB::beginTransaction();
      try {
         $request = DB::table('withdrawal_request_by_point')->where('id','=',$id)->first();
         $user_id = $request->user_id;
         DB::table('withdrawal_request_by_point')->where('id','=',$id)->update(['status'=>'Withdrawn']);
         $this->pointDistributionLog($user_id,$request->point);
         $this->response = ['success'=>TRUE,'message'=>__('Withdraw successful.')];
         DB::commit();
      }catch (\Exception $e){
         $this->response = ['success'=>FALSE,'message'=> $e->getMessage()];
         DB::rollback();
      }
      return $this->response;
   }
   
   private function pointDistributionLog($user_id,$points){
      DB::table('user_point_distribution_log')->insert([
         'admin_setting_slug' =>'withdrawal_request_by_point',
         'operation_type' =>'Subtract',
         'user_id' => $user_id,
         'point' => $points,
      ]);
   }
}