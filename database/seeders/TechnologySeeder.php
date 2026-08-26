<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['name' => 'PHP', 'icon' => 'ri-code-s-slash-line'],
            ['name' => 'Laravel', 'icon' => 'ri-code-box-line'],
            ['name' => 'CodeIgniter', 'icon' => 'ri-code-box-line'],
            ['name' => 'MySQL', 'icon' => 'ri-database-2-line'],
            ['name' => 'SQL Server', 'icon' => 'ri-database-2-line'],
            ['name' => 'JavaScript', 'icon' => 'ri-javascript-line'],
            ['name' => 'Bootstrap', 'icon' => 'ri-layout-line'],
            ['name' => 'ASP.Net C#', 'icon' => 'ri-code-s-slash-line'],
        ];

        foreach ($technologies as $technology) {
            Technology::updateOrCreate(['name' => $technology['name']], $technology);
        }
    }
}
