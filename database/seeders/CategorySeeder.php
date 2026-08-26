<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Web', 'type' => 'project'],
            ['name' => 'Mobile', 'type' => 'project'],
            ['name' => 'Desktop', 'type' => 'project'],
            ['name' => 'Tutorial', 'type' => 'post'],
            ['name' => 'Case Study', 'type' => 'post'],
            ['name' => 'Opinion', 'type' => 'post'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name']) . '-' . $category['type']],
                [
                    'name' => $category['name'],
                    'slug' => Str::slug($category['name']) . '-' . $category['type'],
                    'type' => $category['type'],
                ]
            );
        }
    }
}
