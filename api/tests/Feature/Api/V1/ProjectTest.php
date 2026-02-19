<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);
    }

    /** @test */
    public function it_lists_only_active_projects_publicly()
    {
        $category = Category::factory()->create();
        Project::factory()->create(['is_active' => true, 'category_id' => $category->id]);
        Project::factory()->create(['is_active' => false, 'category_id' => $category->id]);

        $response = $this->getJson('/api/v1/projects');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    /** @test */
    public function it_tracks_project_views()
    {
        $category = Category::factory()->create();
        $project = Project::factory()->create(['category_id' => $category->id]);

        $this->postJson("/api/v1/projects/{$project->slug}/track")
            ->assertStatus(200);

        $this->assertEquals(1, $project->pageViews()->count());
    }

    /** @test */
    public function admin_can_create_a_project()
    {
        $this->actingAs($this->admin);
        $category = Category::factory()->create();

        $data = [
            'title' => 'New Project',
            'slug' => 'new-project',
            'description' => 'Test description',
            'short_description' => 'Short desc',
            'category_id' => $category->id,
            'status' => 'live',
        ];

        $this->postJson('/api/v1/admin/projects', $data)
            ->assertStatus(201);

        $this->assertDatabaseHas('projects', ['title' => 'New Project']);
    }

    /** @test */
    public function admin_can_stop_and_start_a_project()
    {
        $this->actingAs($this->admin);
        $category = Category::factory()->create();
        $project = Project::factory()->create(['is_active' => true, 'category_id' => $category->id]);

        // Stop
        $this->postJson("/api/v1/admin/projects/{$project->id}/stop")
            ->assertStatus(200);
        $this->assertFalse($project->fresh()->is_active);

        // Start
        $this->postJson("/api/v1/admin/projects/{$project->id}/start")
            ->assertStatus(200);
        $this->assertTrue($project->fresh()->is_active);
    }

    /** @test */
    public function admin_can_duplicate_a_project()
    {
        $this->actingAs($this->admin);
        $category = Category::factory()->create();
        $project = Project::factory()->create(['category_id' => $category->id]);

        $this->postJson("/api/v1/admin/projects/{$project->id}/duplicate")
            ->assertStatus(201)
            ->assertJsonPath('data.title', $project->title . ' (Copy)');
    }

    /** @test */
    public function it_can_toggle_project_via_artisan_commands()
    {
        $category = Category::factory()->create();
        $project = Project::factory()->create(['is_active' => true, 'slug' => 'artisan-project', 'category_id' => $category->id]);

        // Down
        $this->artisan('project:down artisan-project')
            ->expectsOutput("Project [{$project->title}] is now OFFLINE.")
            ->assertExitCode(0);
        $this->assertFalse($project->fresh()->is_active);

        // Up
        $this->artisan('project:up artisan-project')
            ->expectsOutput("Project [{$project->title}] is now ONLINE.")
            ->assertExitCode(0);
        $this->assertTrue($project->fresh()->is_active);
    }
}
