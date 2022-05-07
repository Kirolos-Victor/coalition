<?php
namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(TaskRequest $request)
    {
        $tasks = Task::fetchTasks($request);
        return view('tasks.index', compact('tasks'));
    }

    public function create(Request $request)
    {
        $projects = Project::all();
        $projectId = $request->project_id;
        return view('tasks.create', compact('projects', 'projectId'));
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create($request->all());
        return redirect()->route('tasks.index', ['project_id' => $request->main_project_id])->with(
            'message',
            'created successfully'
        );
    }

    public function edit(Request $request, Task $task)
    {
        $projects = Project::all();
        $projectId = $request->project_id;
        return view('tasks.edit', compact('task', 'projects', 'projectId'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return redirect()->route('tasks.index', ['project_id' => $request->main_project_id])->with(
            'message',
            'updated successfully'
        );
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message'=>'deleted'], 200);
    }

    public function updatePriority(Request $request, TaskService $service)
    {
        return $service->updatePriority($request);
    }
}
