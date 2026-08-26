<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_project(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Web App',
            'slug' => 'web-app',
            'type' => 'project',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->post($this->adminUrl('/projects'), [
            'title' => 'My Test Project',
            'category_id' => $category->id,
            'description' => 'A project created during a test.',
            'order' => 0,
            'status' => 'draft',
        ]);

        $response->assertRedirect($this->adminUrl('/projects'));
        $this->assertDatabaseHas('projects', [
            'title' => 'My Test Project',
            'category_id' => $category->id,
        ]);
    }

    public function test_admin_can_update_a_project(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Web App',
            'slug' => 'web-app',
            'type' => 'project',
            'is_active' => true,
        ]);
        $project = Project::create([
            'title' => 'Original Title',
            'slug' => 'original-title',
            'category_id' => $category->id,
            'description' => 'Original description.',
            'order' => 0,
            'status' => 'draft',
        ]);

        $response = $this->actingAs($user)->put($this->adminUrl("/projects/{$project->id}"), [
            'title' => 'Updated Title',
            'category_id' => $category->id,
            'description' => 'Updated description.',
            'order' => 1,
            'status' => 'published',
        ]);

        $response->assertRedirect($this->adminUrl('/projects'));
        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Updated Title',
            'status' => 'published',
        ]);
    }

    public function test_admin_can_delete_a_project(): void
    {
        $user = User::factory()->create();
        $category = Category::create([
            'name' => 'Web App',
            'slug' => 'web-app',
            'type' => 'project',
            'is_active' => true,
        ]);
        $project = Project::create([
            'title' => 'To Be Deleted',
            'slug' => 'to-be-deleted',
            'category_id' => $category->id,
            'description' => 'Will be deleted.',
            'order' => 0,
            'status' => 'draft',
        ]);

        $response = $this->actingAs($user)->delete($this->adminUrl("/projects/{$project->id}"));

        $response->assertRedirect($this->adminUrl('/projects'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_guest_cannot_create_a_project(): void
    {
        $category = Category::create([
            'name' => 'Web App',
            'slug' => 'web-app',
            'type' => 'project',
            'is_active' => true,
        ]);

        $response = $this->post($this->adminUrl('/projects'), [
            'title' => 'Unauthorized Project',
            'category_id' => $category->id,
            'description' => 'Should not be created.',
            'order' => 0,
            'status' => 'draft',
        ]);

        $response->assertRedirect($this->adminUrl('/login'));
        $this->assertDatabaseMissing('projects', ['title' => 'Unauthorized Project']);
    }
}
