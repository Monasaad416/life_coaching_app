<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatmentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
      {
        $paymentMethods = [
           ["Cache On Deliver","نقدا عند الإستلام"],
            ["Myfatoorah","مي فاتورة"],
            ["Paypal","باي بال"],
            ["Stripe","سترايب"],
            ["Paymop","باي موب"],
        ];


         foreach ($paymentMethods as $method) {
             PaymentMethod::create(
                 [
                     'name_en' => $method[0],
                     'name_ar' => $method[1],
                 ],
             );
         }
    }
}
