<?php

namespace Database\Seeders;

use App\Models\Vendor;
use http\Client\Curl\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{

        $user = \App\Models\User::where('email','admin@gmail.com')->first();
        $vendor = new Vendor();
        $vendor->banner = 'upload/1234.jpg';
        $vendor->shop_name = 'Admin Shop';
        $vendor->phone = '1234567';
        $vendor->email = 'admin@gmail.com';
        $vendor->address = 'AL';
        $vendor->description = 'shop description';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
