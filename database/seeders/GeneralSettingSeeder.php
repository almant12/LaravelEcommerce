<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalSetting = new GeneralSetting();
        $generalSetting->site_name = 'Doko Shop';
        $generalSetting->layout = 'LTR';
        $generalSetting->contact_email = 'dokokalmant123@gmail.com';
        $generalSetting->currency_name = 'Albania Lek';
        $generalSetting->currency_icon = 'ALL';
        $generalSetting->time_zone = 'UTC';
        $generalSetting->save();
    }
}
