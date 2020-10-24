<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FeatureRequest;
use App\Http\Requests\Admin\LicenseRequest;
use App\Http\Requests\Admin\SettingRequest;
use App\Http\Requests\Admin\WebSettingRequest;
use App\Model\AdminSetting;
use App\Model\WebFeature;
use App\Services\CommonService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppSettingController extends Controller {
    public function appSetting() {
        $data['pageTitle'] = __('Application Setting');
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'appsetting';
        $data['adm_setting'] = allsetting();
        
        return view('admin.app_setting', $data);
    }
    
    private function update_or_create($slug,$value){
      return AdminSetting::updateOrCreate(['slug' =>$slug],['slug' =>$slug, 'value' =>$value]);
    }
    
    public function appSettingSave(Request $request){
      
       try {
          if (!empty($request->reward_system_as)){
             $update = $this->update_or_create('reward_system_as',$request->reward_system_as);
          }
          if (!empty($request->register_though_affiliate)){
             $update = $this->update_or_create('register_though_affiliate',$request->register_though_affiliate);
          }
          if (!empty($request->affiliate_owner_on_register)){
             $update = $this->update_or_create('affiliate_owner_on_register',$request->affiliate_owner_on_register);
          }
          if (!empty($request->affiliate_owner_on_purchase)){
             $update = $this->update_or_create('affiliate_owner_on_purchase',$request->affiliate_owner_on_purchase);
          }
          if (!empty($request->point_amount_per_unit)){
             $update = $this->update_or_create('point_amount_per_unit',$request->point_amount_per_unit);
          }
          if (!empty($request->minimum_point_to_withdrawal)){
             $update = $this->update_or_create('minimum_point_to_withdrawal',$request->minimum_point_to_withdrawal);
          }
          if (isset($request->withdrawal_choice)){
             $update = $this->update_or_create('withdrawal_choice',$request->withdrawal_choice);
          }
          if (!empty($request->reward_system_as)){
             $update = $this->update_or_create('reward_system_as',$request->reward_system_as);
          }
          if (isset($request->daily_login_reward)){
             $update = $this->update_or_create('daily_login_reward',$request->daily_login_reward);
          }
          if (!empty($request->daily_login_reward_amount)){
             $update = $this->update_or_create('daily_login_reward_amount',$request->daily_login_reward_amount);
          }
          if (!empty($request->on_registration_reward)){
             $update = $this->update_or_create('on_registration_reward',$request->on_registration_reward);
          }
          if (!empty($request->on_purchase_reward)){
             $update = $this->update_or_create('on_purchase_reward',$request->on_purchase_reward);
          }
          if (!empty($request->daily_topper_reward_amount)){
             $update = $this->update_or_create('daily_topper_reward_amount',$request->daily_topper_reward_amount);
          }
          if (!empty($request->weekly_topper_reward_amount)){
             $update = $this->update_or_create('weekly_topper_reward_amount',$request->weekly_topper_reward_amount);
          }
          if (!empty($request->monthly_topper_reward_amount)){
             $update = $this->update_or_create('monthly_topper_reward_amount',$request->monthly_topper_reward_amount);
          }
          return redirect()->back()->with(['success' => __('Updated Successfully')]);
       }catch (\Exception $e){
          return redirect()->back()->with(['dismiss' => __('Something went wrong')]);
       }
       
    }
    
}
