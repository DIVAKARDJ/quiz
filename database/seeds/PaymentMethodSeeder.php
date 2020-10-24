<?php

use App\Model\PaymentMethods;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethods::create(['name'=>'Paypal', 'status' => 1]);
        PaymentMethods::create(['name'=>'Credit Card', 'status' => 1]);
        PaymentMethods::create(['name'=>'RazorPay', 'status' => 1]);
        PaymentMethods::create(['name'=>'PayU', 'status' => 1]);
    }
}
