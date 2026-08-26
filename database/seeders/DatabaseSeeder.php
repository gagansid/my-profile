<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ProfileInfoSeeder::class,
            SocialLinkSeeder::class,
            ExperienceSeeder::class,
            EducationSeeder::class,
            SkillSeeder::class,
            TechnologySeeder::class,
            CategorySeeder::class,
            ProjectSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
