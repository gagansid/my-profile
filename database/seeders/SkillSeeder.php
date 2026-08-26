<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'HTML', 'category' => 'frontend', 'order' => 1],
            ['name' => 'Bootstrap', 'category' => 'frontend', 'order' => 2],
            ['name' => 'JavaScript', 'category' => 'frontend', 'order' => 3],
            ['name' => 'ASP.Net', 'category' => 'frontend', 'order' => 4],
            ['name' => 'Git', 'category' => 'frontend', 'order' => 5],
            ['name' => 'PHP', 'category' => 'backend', 'order' => 6],
            ['name' => 'C#', 'category' => 'backend', 'order' => 7],
            ['name' => 'MySQL', 'category' => 'backend', 'order' => 8],
            ['name' => 'SQL Server', 'category' => 'backend', 'order' => 9],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }
    }
}
