<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(AdminProfileSeeder::class);
        // $this->call(VendorShopProfileSeeder::class);
        $this->call(HomePageSettingSeeder::class);
        $this->call(ProductSliderSectionOneSeeder::class);
        $this->call(ProductSliderSectionTwoSeeder::class);
        $this->call(ProductSliderSectionThreeSeeder::class);
        $this->call(HomePageSectionBannerOneSeeder::class);
        $this->call(StripeSettingSeeder::class);
        $this->call(PaypalSettingSeeder::class);

        $this->call(GeneralSettingSeeder::class);
        $this->call(LogoSettingsSeeder::class);
        $this->call(PusherSettingsSeeder::class);
    }
}
