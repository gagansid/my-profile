<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $webCategory = Category::query()->where('type', 'project')->where('name', 'Web')->first();

        $projects = [
            [
                'title' => 'Kuesioner Biro Administrasi Akademik dan Kemahasiswaan',
                'thumbnail_path' => 'seed/img/project/kuesioner.jpg',
                'technologies' => ['PHP', 'CodeIgniter', 'MySQL'],
            ],
            [
                'title' => 'Virtual Class',
                'thumbnail_path' => 'seed/img/project/virtual-class.jpg',
                'technologies' => ['PHP', 'CodeIgniter', 'MySQL'],
            ],
        ];

        foreach ($projects as $index => $data) {
            $project = Project::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'category_id' => $webCategory?->id,
                    'thumbnail_path' => $data['thumbnail_path'],
                    'order' => $index + 1,
                    'status' => 'published',
                ]
            );

            $technologyIds = Technology::query()->whereIn('name', $data['technologies'])->pluck('id');
            $project->technologies()->sync($technologyIds);

            $tag = Tag::firstOrCreate(['slug' => 'php'], ['name' => 'PHP']);
            $project->tags()->syncWithoutDetaching([$tag->id]);
        }
    }
}
