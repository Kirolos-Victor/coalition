<?php
namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_tasks_index_page()
    {
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    public function test_tasks_create_page()
    {
        $response = $this->get('/tasks/create');
        $response->assertStatus(200);
    }

    public function test_tasks_edit_page()
    {
        $response = $this->get('/tasks/1/edit');
        $response->assertStatus(200);
    }

    public function test_store_task()
    {
        Task::create([
            'name' => 'Second Task',
            'project_id' => 1,
            'priority' => 2
        ]);
        $response = $this->get('/tasks');
        $response->assertStatus(200)
            ->assertSee('Second Task');
    }

    public function test_update_task()
    {
        $task = Task::where('name', 'Second Task')->first();
        $task->update([
            'name' => 'Updated Task',
            'project_id' => 1,
            'priority' => 2
        ]);
        $response = $this->get('/tasks');
        $response->assertStatus(200)
            ->assertSee('Updated Task');
    }

    public function test_delete_task_response()
    {
        $task = Task::where('name', 'Updated Task')->first();
        $response = $this->delete('tasks/' . $task->id);
        $response->assertJson(['message' => 'deleted']);
    }

    public function test_name_is_required_in_the_store_method()
    {
        $response = $this->post('/tasks', [
            'name' => '',
        ]);
        $response->assertSessionHasErrors('name');
    }

    public function test_project_id_is_required_in_the_store_method()
    {
        $response = $this->post('/tasks', [
            'project_id' => '',
        ]);
        $response->assertSessionHasErrors('project_id');
    }

    public function test_name_is_required_in_the_update_method()
    {
        $response = $this->put('/tasks/1', [
            'name' => '',
        ]);
        $response->assertSessionHasErrors('name');
    }

    public function test_project_id_is_required_in_the_update_method()
    {
        $response = $this->put('/tasks/1', [
            'project_id' => '',
        ]);
        $response->assertSessionHasErrors('project_id');
    }
}
