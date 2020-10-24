<?php


namespace App\Services;


use App\Model\AdminSetting;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReferralService {
   public $response;
   public function __construct() {
      $this->response = ['success'=>FALSE,'message'=>''];
   }
   
   public function referral(){
      $data['pageTitle'] = __('Referral System');
      $data['all_settings'] = allsetting();
      $referral_code = Auth::user()->referral_code;
      if (!empty($referral_code)){
         $data['referral_code'] = $referral_code;
      }else{
         $rand = randomString(10);
         User::where('id',Auth::user()->id)->update(['referral_code'=>$rand]);
         $data['referral_code'] = $rand;
      }
      $data['referral_list'] = DB::table('users')->where('affiliate_id',Auth::user()->id)->get();
      $data['point_histories'] = DB::table('user_point_distribution_log')->where('user_id',Auth::user()->id)->where('operation_type','=','Add')
         ->whereIn('admin_setting_slug',['register_though_affiliate','affiliate_owner_on_register','affiliate_owner_on_purchase'])->get();
      $this->response = ['success'=>TRUE,'message'=>'Referral Data successfully get','data'=>$data];
      return $this->response;
   }
   
   public function referralList(){
      $data['referral_list'] = DB::table('users')->where('affiliate_id',Auth::user()->id)->get();
      $this->response = ['success' => TRUE, 'data' => $data, 'message' => __('Referral List get successful.')];
      return $this->response;
   }
   
   public function referralBonusList(){
      $data['referral_histories'] = DB::table('user_point_distribution_log')->where('user_id',Auth::user()->id)->where('operation_type','=','Add')
                                   ->whereIn('admin_setting_slug',['register_though_affiliate','affiliate_owner_on_register','affiliate_owner_on_purchase'])->get();
      $this->response = ['success' => TRUE, 'data' => $data, 'message' => __('Referral List get successful.')];
      return $this->response;
   }
   
   public function rewardList(){
      $data['rewards'] = DB::table('user_point_distribution_log')->where('user_id',Auth::user()->id)
                           ->whereIn('admin_setting_slug',['daily_login_reward','daily_login_reward_amount','on_registration_reward','on_purchase_reward',
                                                           'daily_topper_reward_amount','weekly_topper_reward_amount','monthly_topper_reward_amount'])
                           ->orderBy('created_at','desc')
                           ->paginate(15);
      $this->response = ['success' => TRUE, 'data' => $data, 'message' => __('Referral List get successful.')];
      return $this->response;
   }
   
   public function rewardPointList(){
      try {
         $data = AdminSetting::whereIn('slug',['daily_login_reward_amount','on_registration_reward','on_purchase_reward','daily_topper_reward_amount','weekly_topper_reward_amount','monthly_topper_reward_amount'])->get();
         $new_array = [];
         foreach ($data as $dt){
            $new_array[$dt->slug] = $dt->value;
         }
         $response['success'] = TRUE;
         $response['data'] = $new_array;
         $response['message'] = __('Reward point list get successfully.');
      }catch (\Exception $e){
         $response['success'] = FALSE;
         $response['message'] = __('Something went wrong.');
      }
      
      return $response;
   }
   
   public function referralLink(){
      $user = Auth::user();
      $data['referral_link'] = url('signup').'/'.$user->referral_code ?? '';
      $this->response['success'] = TRUE;
      $this->response['data'] = $data;
      $this->response['message'] = __('Referral link get successfully.');
      return $this->response;
   }
   
   
   
}