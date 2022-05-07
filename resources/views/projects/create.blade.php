@extends('layouts.app')
@section('content')
    <h1 class="text-center">Create Project</h1>
    <form action="{{route('projects.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="task-name" class="mb-2">Project Name</label>
            <input type="text" class="form-control" id="task-name" name="name">
        </div>
        <button type="submit" class="btn btn-primary mt-5">Create</button>
    </form>
@endsection
