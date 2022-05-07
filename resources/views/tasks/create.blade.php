@extends('layouts.app')
@section('content')
    <h1 class="text-center">Create Task</h1>
    <form action="{{route('tasks.store',['main_project_id'=>$projectId])}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="task-name" class="mb-2">Task Name</label>
            <input type="text" class="form-control" id="task-name" name="name">
        </div>
        <div class="form-group mt-5">
            <label for="project" class="mb-2">Select Project</label>
            <select class="form-control" id="project" name="project_id">
                @foreach($projects as $project)
                    @if($project->id == $projectId)
                        <option value="{{$project->id}}" selected>{{$project->name}}</option>
                    @else
                        <option value="{{$project->id}}">{{$project->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-5">Create</button>
    </form>
@endsection
