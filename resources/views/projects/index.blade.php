@extends('layouts.app')
@section('content')
    <h1>Projects</h1>
    <a class="btn btn-success float-end" href="{{route('projects.create')}}">Create Project</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($projects as $project)
            <tr>
                <th>{{$loop->index+1}}</th>
                <td>{{$project->name}}</td>
                <td><a class="btn btn-primary d-inline-block"href="{{route('tasks.index',['project_id'=>$project->id])}}" >View Lists</a>
                    <form action="{{route('projects.destroy',$project->id)}}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <th colspan="3" class="text-center">No data</th>
            </tr>
        @endforelse

        </tbody>
    </table>
    {{$projects->links()}}
@endsection
