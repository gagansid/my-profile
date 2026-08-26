<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::updateOrCreate(
            ['institution' => 'CIC University Cirebon'],
            [
                'institution' => 'CIC University Cirebon',
                'degree' => "Bachelor's Degree in Computer Science",
                'score' => '3.88/4.00',
                'start_date' => '2017-08-01',
                'end_date' => '2021-09-30',
                'order' => 1,
            ]
        );
    }
}
