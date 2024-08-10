<?php

namespace Database\Seeders;


use App\Models\Advertisement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HomePageSectionBannerOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Sample data
         $data = [
            'banner_url' => 'http://example.com',
            'status' => 1, // active status
            'banner_image' => 'uploads/sample_image.jpg' // sample image path
        ];

        $value = [
            'banner_one' => $data
        ];

        $value = json_encode($value);

             Advertisement::updateOrCreate(
            ['key' => 'homepage_secion_banner_one'],
            ['value' => $value]
        );
    }
}
