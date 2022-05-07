<?php
namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_projects_index_page()
    {
        $response = $this->get('/projects');
        $response->assertStatus(200);
    }

    public function test_projects_create_page()
    {
        $response = $this->get('/projects/create');
        $response->assertStatus(200);
    }

    public function test_store_project()
    {
        Project::create([
            'name' => 'second project'
        ]);
        $response = $this->get('/projects');
        $response->assertStatus(200)
            ->assertSee('second project');
    }

    public function test_delete_project()
    {
        $project = Project::where('name', 'second project')->first();
        $project->delete();
        $response = $this->get('/projects');
        $response->assertStatus(200)
            ->assertSee(!'second project');
    }

    public function test_name_is_required_in_the_store_method()
    {
        $response = $this->post('/projects', [
            'name' => '',
        ]);
        $response->assertSessionHasErrors('name');
    }
}
