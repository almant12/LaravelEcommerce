<?php

namespace Database\Seeders;

use App\Models\HomePageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HomePageSettingSeeder extends Seeder
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
            ],
            [
                'category' => 'Category Three',
                'sub_category' => 'Sub Category Three',
                'child_category' => 'Child Category Three',
            ],
            [
                'category' => 'Category Four',
                'sub_category' => 'Sub Category Four',
                'child_category' => 'Child Category Four',
            ],
        ];

        HomePageSetting::updateOrCreate(
            [
                'key' => 'popular_category_section'
            ],
            [
                'value' => json_encode($data)
            ]
        );
    }
}
