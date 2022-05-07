@extends('layouts.app')
@section('content')
    <h1 class="text-center">Update Task</h1>
    <form action="{{route('tasks.update',$task->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="task-name" class="mb-2">Task Name</label>
            <input type="text" class="form-control" id="task-name" name="name" value="{{$task->name}}">

        </div>
        <div class="form-group mt-5">
            <label for="project" class="mb-2">Select Project</label>
            <select class="form-control" id="project" name="project_id">
                @foreach($projects as $project)
                    @if($project->id == $task->project_id)
                        <option value="{{$project->id}}" selected>{{$project->name}}</option>
                    @else
                        <option value="{{$project->id}}">{{$project->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="hidden" name="main_project_id" value="{{$projectId}}">

        <button type="submit" class="btn btn-primary mt-5">Update</button>
    </form>
@endsection
