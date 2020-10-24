<?php

namespace App\Services;

use App\Model\AdminSetting;
use App\Model\WebFeature;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingService
{
    protected $logger;

    public function __construct()
    {
        $this->logger = app(Logger::class);
        $this->token = 'MYgnsoOUEXsTvWcjhjejKM8XhfLXLjub';
    }

    public function checkValidId($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return ['success' => false];
        }
        return $id;
    }

    private function update_or_create($slug, $value)
    {
        return AdminSetting::updateOrCreate(['slug' => $slug], ['slug' => $slug, 'value' => $value]);
    }

    // save website setting
    public function saveWebsiteSetting($request)
    {
        $response = ['success' => false, 'message' => __('Invalid request')];
        try {
            if (!empty($request->landing_banner_title)) {
                $this->update_or_create('landing_banner_title', $request->landing_banner_title);
            }
            if (!empty($request->landing_banner_des)) {
                $this->update_or_create('landing_banner_des', $request->landing_banner_des);
            }
            if (!empty($request->landing_about_title)) {
                $this->update_or_create('landing_about_title', $request->landing_about_title);
            }
            if (!empty($request->landing_about_des)) {
                $this->update_or_create('landing_about_des', $request->landing_about_des);
            }
            if (!empty($request->work_process_title)) {
                $this->update_or_create('work_process_title', $request->work_process_title);
            }
            if (!empty($request->landing_work_des)) {
                $this->update_or_create('landing_work_des', $request->landing_work_des);
            }
            if (!empty($request->landing_work_step1)) {
                $this->update_or_create('landing_work_step1', $request->landing_work_step1);
            }
            if (!empty($request->landing_work_step2)) {
                $this->update_or_create('landing_work_step2', $request->landing_work_step2);
            }
            if (!empty($request->landing_work_step3)) {
                $this->update_or_create('landing_work_step3', $request->landing_work_step3);
            }
            if (!empty($request->landing_work_step4)) {
                $this->update_or_create('landing_work_step4', $request->landing_work_step4);
            }
            if (!empty($request->landing_download_title)) {
                $this->update_or_create('landing_download_title', $request->landing_download_title);
            }
            if (!empty($request->landing_app_download_link)) {
                $this->update_or_create('landing_app_download_link', $request->landing_app_download_link);
            }
            if (!empty($request->landing_ios_download_link)) {
                $this->update_or_create('landing_ios_download_link', $request->landing_ios_download_link);
            }
            if (!empty($request->landing_download_des)) {
                $this->update_or_create('landing_download_des', $request->landing_download_des);
            }
            if (!empty($request->landing_feature_title)) {
                $this->update_or_create('landing_feature_title', $request->landing_feature_title);
            }
            if (!empty($request->landing_feature_des)) {
                $this->update_or_create('landing_feature_des', $request->landing_feature_des);
            }
            if (isset($request->landing_banner_image)) {
                AdminSetting::updateOrCreate(['slug' => 'landing_banner_image'], ['value' => fileUpload($request['landing_banner_image'], path_image(),
                    isset(allSetting()['landing_banner_image']) ? allSetting()['landing_banner_image'] : '')]);
            }
            if (isset($request->landing_about_image)) {
                AdminSetting::updateOrCreate(['slug' => 'landing_about_image'], ['value' => fileUpload($request['landing_about_image'], path_image(),
                    isset(allSetting()['landing_about_image']) ? allSetting()['landing_about_image'] : '')]);
            }
            if (isset($request->service_banner_image)) {
                AdminSetting::updateOrCreate(['slug' => 'service_banner_image'], ['value' => fileUpload($request['service_banner_image'], path_image(),
                    isset(allSetting()['service_banner_image']) ? allSetting()['service_banner_image'] : '')]);
            }
            if (isset($request->team_banner_image)) {
                AdminSetting::updateOrCreate(['slug' => 'team_banner_image'], ['value' => fileUpload($request['team_banner_image'], path_image(),
                    isset(allSetting()['team_banner_image']) ? allSetting()['team_banner_image'] : '')]);
            }
            if (isset($request->portfolio_banner_image)) {
                AdminSetting::updateOrCreate(['slug' => 'portfolio_banner_image'], ['value' => fileUpload($request['portfolio_banner_image'], path_image(),
                    isset(allSetting()['portfolio_banner_image']) ? allSetting()['portfolio_banner_image'] : '')]);
            }
            if (isset($request->gallery_banner_image)) {
                AdminSetting::updateOrCreate(['slug' => 'gallery_banner_image'], ['value' => fileUpload($request['gallery_banner_image'], path_image(),
                    isset(allSetting()['gallery_banner_image']) ? allSetting()['gallery_banner_image'] : '')]);
            }

            $response = [
                'success' => true,
                'message' => __('Updated Successfully.')
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return $response;
    }

    //save web feature

    public function webFeatureSave($request)
    {
        $response = ['success' => false, 'message' => __('Invalid request')];
        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
            ];
            if (isset($request->edit_id)) {
                $item = WebFeature::where('id', $request->edit_id)->first();
            }
            if (!empty($request->image)) {
                $old_img = '';
                if (!empty($item->image)) {
                    $old_img = $item->image;
                }
                $data['image'] = fileUpload($request->image, path_image(), $old_img);
            }

            if (!empty($request->edit_id)) {
                $update = WebFeature::where(['id' => $request->edit_id])->update($data);
                if ($update) {
                    $response = [
                        'success' => true,
                        'message' => __('Feature updated successfully')
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => __('Failed to update')
                    ];
                }
            } else {
                $saveData = WebFeature::create($data);
                if ($saveData) {
                    $response = [
                        'success' => true,
                        'message' => __('New feature created successfully.')
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => __('Failed to create')
                    ];
                }
            }

        } catch (\Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage()
//                'message' => __('Something Went wrong !')
            ];
            return $response;
        }

        return $response;
    }

    // delete feature
    public function deleteFeature($id)
    {
        $response = ['success' => false, 'message' => __('Invalid request')];
        DB::beginTransaction();
        try {
            $item = WebFeature::where('id', $id)->first();
            if (isset($item)) {
                if (!empty($item->image)) {
                    $img = get_image_name($item->image);
                    removeImage(path_image(), $img);
                }
                $delete = $item->delete();
                if ($delete) {
                    $response = [
                        'success' => true,
                        'message' => __('Feature deleted successfully.')
                    ];
                } else {
                    DB::rollBack();
                    $response = [
                        'success' => false,
                        'message' => __('Operation failed.')
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => __('Feature not found.')
                ];
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
            return $response;
        }
        DB::commit();
        return $response;
    }

    // check envato purchase code
    public function checkEnvatoPurchaseCode($request)
    {
        //SETUP THE API DATA
        $response = ['success' => false, 'message' => __('Invalid request')];
        try {
            $token = $this->token;
            $purchase_code = $request->purchase_code;

            $purchase_code = htmlspecialchars($purchase_code);
            $o = $this->verifyPurchase($purchase_code, $token);
            if (is_object($o)) {
//                dd($o);
                $this->update_or_create('is_authenticated',LICENSE_VERIFIED);
                $response = ['success' => true, 'message' => __('Purchase code verified successfully.')];
            } else {
                $response = ['dismiss' => true, 'message' => __('Sorry, This is not a valid purchase code or this user have not purchased any of your items.')];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }

        return $response;
    }

    public function verifyPurchase($code, $token)
    {
        $verify_obj = $this->getPurchaseData($code, $token);

        // Check for correct verify code
        if (
            (false === $verify_obj) ||
            !is_object($verify_obj) ||
            !isset($verify_obj->{"verify-purchase"}) ||
            !isset($verify_obj->{"verify-purchase"}->item_name)
        )
            return -1;

        // If empty or date present, then it's valid
        if (
            $verify_obj->{"verify-purchase"}->supported_until == "" ||
            $verify_obj->{"verify-purchase"}->supported_until != null
        )
            return $verify_obj->{"verify-purchase"};

        // Null or something non-string value, thus support period over
        return 0;

    }

    public function getPurchaseData($code, $token)
    {

        //setting the header for the rest of the api
        $bearer = 'bearer ' . $token;
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:' . $code . '.json';
        $ch_verify = curl_init($verify_url . '?code=' . $code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        if ($cinit_verify_data != "")
            return json_decode($cinit_verify_data);
        else
            return false;

    }

}

