<?php

namespace Database\Seeders;

use App\Models\ProfileInfo;
use Illuminate\Database\Seeder;

class ProfileInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileInfo::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Gagan Suganda',
                'profession' => 'Web developer',
                'summary' => "I am website developer with 2 years of experience in website development, using CodeIgniter for developing a website and web applications. I am a graduate of CIC Catur Insan Cendekia Cirebon majoring in Computer Science. I have the ability to program using PHP, ASP.Net C#, Javascript, Codeigniter, MySQL, SQL Server, and Git. Have good analytical and communication skills and be able to work individually or in a team.",
                'avatar_path' => 'seed/img/profile.png',
                'cv_path' => 'seed/pdf/gagansuganda-cv.pdf',
                'years_experience' => 7,
                'completed_projects' => 124,
                'satisfied_customers' => 96,
            ]
        );
    }
}
