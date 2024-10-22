<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaypalSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('paypal_settings')->insert([
            'status' => true, // or false depending on your default setting
            'mode' => false, // false for sandbox mode, true for live mode
            'country_name' => 'United States',
            'currency_name' => 'USD',
            'currency_rate' => 1.0,
            'client_id' => 'your-client-id-here',
            'secret_key' => 'your-secret-key-here'
        ]);
    }
}
