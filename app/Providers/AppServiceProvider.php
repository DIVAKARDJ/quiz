<?php

namespace App\Providers;

use Braintree_Configuration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\KeysCommand;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend('phone_number', function ($attribute, $value, $parameters, $validator) {
            $first = substr($value, 0, 1);
            if ($first == '+') {
                $value = substr($value, 1);
            }
            return ctype_digit($value);
        });
        Validator::extend('strong_pass', function($attribute, $value, $parameters, $validator) {
            return is_string($value);
        });
//        bcscale(8);
//        if (DB::connection()->getDatabaseName()) {
//            if (Schema::hasTable('admin_settings')) {
//                $allSetting = allsetting();
//                Braintree_Configuration::environment(isset($allSetting['braintree_mode']) ? $allSetting['braintree_mode'] : env('BRAINTREE_ENV'));
//                Braintree_Configuration::merchantId(isset($allSetting['braintree_marchant_id']) ? $allSetting['braintree_marchant_id'] : env('BRAINTREE_MERCHANT_ID'));
//                Braintree_Configuration::publicKey(isset($allSetting['braintree_public_key']) ? $allSetting['braintree_public_key'] : env('BRAINTREE_PUBLIC_KEY'));
//                Braintree_Configuration::privateKey(isset($allSetting['braintree_private_key']) ? $allSetting['braintree_private_key'] : env('BRAINTREE_PRIVATE_KEY'));
//            }
//        }

        Passport::routes();

        /*ADD THIS LINES*/
        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
