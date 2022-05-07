<?php
namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_project_id_exist_in_database()
    {
        $task = Task::first();
        $project = Project::find($task->project_id);
        $this->assertTrue($project != null);
    }
}
