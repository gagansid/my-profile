<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'is_site_public' => true,
                'show_about' => true,
                'show_projects' => true,
                'show_blog' => true,
                'show_contact' => true,
            ]
        );
    }
}
