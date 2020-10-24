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

class SettingController extends Controller
{
    /*
    * generalSetting
    *
    * general Setting
    *
    *
    *
    *
    */

    public function generalSetting()
    {
        $data['pageTitle'] = __('General Setting');
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'gsetting';
        $data['adm_setting'] = allsetting();

        return view('admin.setting', $data);
    }

    /*
    * saveSettings
    *
    * save admin setting data
    *
    *
    *
    *
    */
   private function update_or_create($slug,$value){
      return AdminSetting::updateOrCreate(['slug' =>$slug],['slug' =>$slug, 'value' =>$value]);
   }

    public function saveSettings(SettingRequest $request)
    {
        try {
            if (isset($request->company_name)) {
                AdminSetting::where(['slug' => 'company_name'])->update(['value' => $request->company_name]);
            }
            if (isset($request->lang)) {
                AdminSetting::where(['slug' => 'lang'])->update(['value' => $request->lang]);
            }
            if (isset($request->user_registration)) {
                AdminSetting::where(['slug' => 'user_registration'])->update(['value' => $request->user_registration]);
            }
            if (isset($request->app_title)) {
                AdminSetting::where(['slug' => 'app_title'])->update(['value' => $request->app_title]);
            }
            if (isset($request->primary_email)) {
                AdminSetting::where(['slug' => 'primary_email'])->update(['value' => $request->primary_email]);
            }
            if (isset($request->copyright_text)) {
                AdminSetting::where(['slug' => 'copyright_text'])->update(['value' => $request->copyright_text]);
            }
            if (isset($request->hints_coin)) {
                AdminSetting::updateOrCreate(['slug' => 'hints_coin'],['value' => $request->hints_coin]);
            }
            if (isset($request->fifty_fifty_answer)) {
                AdminSetting::updateOrCreate(['slug' => 'fifty_fifty_answer'],['value' => $request->fifty_fifty_answer]);
            }
            if (isset($request->admob_coin)) {
                AdminSetting::updateOrCreate(['slug' => 'admob_coin'],['value' => $request->admob_coin]);
            }
            if (isset($request->signup_coin)) {
                AdminSetting::updateOrCreate(['slug' => 'signup_coin'],['value' => $request->signup_coin]);
            }
            if (isset($request->privacy_policy)) {
                AdminSetting::updateOrCreate(['slug' => 'privacy_policy'],['value' => $request->privacy_policy]);
            }
            if (isset($request->login_text)) {
                AdminSetting::updateOrCreate(['slug' => 'login_text'],['value' => $request->login_text]);
            }
            if (isset($request->signup_text)) {
                AdminSetting::updateOrCreate(['slug' => 'signup_text'],['value' => $request->signup_text]);
            }
            if (isset($request->terms_conditions)) {
                AdminSetting::updateOrCreate(['slug' => 'terms_conditions'],['value' => $request->terms_conditions]);
            }
            if (isset($request->logo)) {
//                AdminSetting::updateOrCreate(['slug' => 'logo'], ['value' => uploadthumb($request->logo, path_image(), 'logo_', '', '', allsetting()['logo'])]);
                AdminSetting::updateOrCreate(['slug' => 'logo'], ['value' => fileUpload($request['logo'], path_image(), allsetting()['logo'])]);
            }
            if (isset($request->favicon)) {
                AdminSetting::updateOrCreate(['slug' => 'favicon'], ['value' => fileUpload($request['favicon'], path_image(), allsetting()['favicon'])]);
            }
            if (isset($request->login_logo)) {
                AdminSetting::updateOrCreate(['slug' => 'login_logo'], ['value' => fileUpload($request['login_logo'], path_image(), allsetting()['login_logo'])]);
            }

            return redirect()->back()->with(['success' => __('Updated Successfully')]);
        } catch (\Exception $e) {
//            dd($e->getMessage());
            return redirect()->back()->with(['dismiss' => __('Something went wrong')]);
        }
    }

    // save payment setting
    public function savePaymentSettings(Request $request)
    {
        try {
           if (isset($request->payment_method) && !empty($request->payment_method) ){
              $update = $this->update_or_create('payment_method',$request->payment_method);
           }
           if (isset($request->braintree_mode)) {
                AdminSetting::updateOrCreate(['slug' => 'braintree_mode'],['value' => $request->braintree_mode]);
            }
            if (isset($request->braintree_marchant_id)) {
                AdminSetting::updateOrCreate(['slug' => 'braintree_marchant_id'],['value' => $request->braintree_marchant_id]);
            }
            if (isset($request->braintree_public_key)) {
                AdminSetting::updateOrCreate(['slug' => 'braintree_public_key'],['value' => $request->braintree_public_key]);
            }
            if (isset($request->braintree_private_key)) {
                AdminSetting::updateOrCreate(['slug' => 'braintree_private_key'],['value' => $request->braintree_private_key]);
            }
            if (isset($request->braintree_client_token)) {
                AdminSetting::updateOrCreate(['slug' => 'braintree_client_token'],['value' => $request->braintree_client_token]);
            }
           if (isset($request->razorpay_api_key) && !empty($request->razorpay_api_key)){
              $update = $this->update_or_create('razorpay_api_key',$request->razorpay_api_key);
           }
           if (isset($request->razorpay_api_app_name) && !empty($request->razorpay_api_app_name)){
              $update = $this->update_or_create('razorpay_api_app_name',$request->razorpay_api_app_name);
           }
           if (isset($request->razorpay_api_app_description) && !empty($request->razorpay_api_app_description)){
              $update = $this->update_or_create('razorpay_api_app_description',$request->razorpay_api_app_description);
           }
           if (isset($request->payu_merchant_id) && !empty($request->payu_merchant_id)){
              $update = $this->update_or_create('payu_merchant_id',$request->payu_merchant_id);
           }
           if (isset($request->payu_merchant_key) && !empty($request->payu_merchant_key)){
              $update = $this->update_or_create('payu_merchant_key',$request->payu_merchant_key);
           }
           if (isset($request->payu_salt) && !empty($request->payu_salt)){
              $update = $this->update_or_create('payu_salt',$request->payu_salt);
           }
           if (isset($request->payu_description) && !empty($request->payu_description)){
              $update = $this->update_or_create('payu_description',$request->payu_description);
           }
            return redirect()->back()->with(['success' => __('Updated Successfully')]);
        } catch (\Exception $e) {
//            dd($e->getMessage());
            return redirect()->back()->with(['dismiss' => __('Something went wrong')]);
        }
    }

    // web site landing setting
    public function webSetting()
    {
        $data['pageTitle'] = __('Website Setting');
        $data['menu'] = 'setting';
        $data['sub_menu'] = 'websetting';
        $data['adm_setting'] = allsetting();
        $data['items'] = WebFeature::orderBy('id','desc')->get();

        return view('admin.setting.web-setting', $data);
    }

    // web site landing setting
    public function webSettingSaveProcess(WebSettingRequest $request)
    {
        try {
            $response = app(SettingService::class)->saveWebsiteSetting($request);
            if ($response) {
                if ($response['success'] == true) {
                    return redirect()->back()->withInput()->with('success', $response['message']);
                } else {
                    return redirect()->back()->withInput()->with('dismiss', $response['message']);
                }
            } else {
                return redirect()->back()->withInput()->with('dismiss', __('Something went wrong'));
            }

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('success', $e->getMessage());
        }
    }

    // add new feature
    public function addWebFeature()
    {
        $data['pageTitle'] = __('Add New Feature');
        $data['menu'] = 'websetting';

        return view('admin.setting.add-edit', $data);
    }

    // save web feature
    public function saveWebFeature(FeatureRequest $request)
    {
        $response = app(SettingService::class)->webFeatureSave($request);
        if (isset($response['success']) && $response['success'] == true) {
            return redirect()->route('webSetting')->with('success', $response['message']);
        }

        return redirect()->back()->withInput()->with('dismiss', $response['message']);
    }

    // edit web feature
    public function editWebFeature($id)
    {
        $data['pageTitle'] = __('Update Web Feature');
        $data['menu'] = 'websetting';
        $id = app(CommonService::class)->checkValidId($id);
        if (is_array($id)) {
            return redirect()->back()->with(['dismiss' => __('Feature not found.')]);
        }
        $data['item'] = WebFeature::where('id',$id)->first();

        return view('admin.setting.add-edit', $data);
    }

    // delete web feature
    public function featureDelete($id)
    {
        if (isset($id)) {
            $id = app(CommonService::class)->checkValidId($id);
            if (is_array($id)) {
                return redirect()->back()->with(['dismiss' => __('Item not found.')]);
            }
            $response = app(SettingService::class)->deleteFeature($id);
            if ($response['success'] == true) {
                return redirect()->route('webSetting')->with('success', $response['message']);
            }

            return redirect()->back()->withInput()->with('dismiss', $response['message']);
        }
        return redirect()->back();
    }

    public function verifyEnvatoCode(LicenseRequest $request)
    {
        $response = app(SettingService::class)->checkEnvatoPurchaseCode($request);
        if ($response['success'] == true) {
            return redirect()->route('generalSetting')->with('success', $response['message']);
        }

        return redirect()->back()->withInput()->with('dismiss', $response['message']);
    }
}
