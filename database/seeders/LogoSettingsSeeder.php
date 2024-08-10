<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LogoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('logo_settings')->insert([
            [
                'logo' => 'path/to/default/logo.png',
                'footer_logo' => 'path/to/default/footer_logo.png',
                'favicon' => 'path/to/default/favicon.ico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
