<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                'company' => 'PT. Ipro Solusi Canggih',
                'position' => 'Programmer',
                'start_date' => '2022-10-01',
                'end_date' => '2023-12-31',
                'description' => "Implementing modifications based on the blueprint provided by the systems analyst.\nAdjusting the source code using Visual Studio and uploading the work to Bitbucket.\nModifying the database structure using SQL Server Management Studio.\nResolving bugs identified by testers during the System Integration Testing (SIT) and User Acceptance Testing (UAT) processes.",
                'order' => 1,
            ],
            [
                'company' => 'PT. Lee Yin Gapuran Garment Indonesia',
                'position' => 'PPIC',
                'start_date' => '2022-01-01',
                'end_date' => '2022-09-30',
                'description' => "Create material request fabric.\nShare breakdown to admin fabric, admin sewing, admin finishing.\nCreate and share trimcard to production.",
                'order' => 2,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(
                ['company' => $experience['company'], 'position' => $experience['position']],
                $experience
            );
        }
    }
}
