<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PusherSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pusher_settings')->insert([
            [
                'pusher_app_id' => 'your_default_pusher_app_id',
                'pusher_key' => 'your_default_pusher_key',
                'pusher_secret' => 'your_default_pusher_secret',
                'pusher_cluster' => 'your_default_pusher_cluster',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
