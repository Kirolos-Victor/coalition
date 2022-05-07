@extends('layouts.app')
@section('content')
<task-form :tasks="{{$tasks}}"></task-form>
@endsection
