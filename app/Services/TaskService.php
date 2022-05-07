<?php
namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function updatePriority($request)
    {
        $tasks = $request->all();
        foreach ($tasks as $key => $task) {
            $getTask = Task::find($task['id']);
            $getTask->update([
                'priority' => $key
            ]);
        }
        return response()->json('success', 200);
    }
}
