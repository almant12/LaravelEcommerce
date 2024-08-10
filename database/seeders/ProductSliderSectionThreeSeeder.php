<?php

namespace Database\Seeders;

use App\Models\HomePageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSliderSectionThreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'category' => 'Category One',
                'sub_category' => 'Sub Category One',
                'child_category' => 'Child Category One',
            ],
            [
                'category' => 'Category Two',
                'sub_category' => 'Sub Category Two',
                'child_category' => 'Child Category Two',
            ]
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'product_slider_section_three'
            ],
            [
                'value' => json_encode($data)
            ]
        );
    }
}
