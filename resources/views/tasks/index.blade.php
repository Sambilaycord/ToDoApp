@extends('layouts.app')

@section('content')
<h1>Task List</h1>

@foreach($tasks as $task)
<div class="card 
@if($task->isCompleted()) 
    border-success 
@else
    border-info
@endif" style="margin-bottom:20px;">
    <div class="card-body">
        <h5>
        @if($task->isCompleted())
            <span class="badge badge-success">Completed</span>
        @else
            <span class="badge badge-secondary">Incomplete</span>
        @endif    
        </h5>
        <h4> 
            {{ $task->description }}
        </h4>
        <div class="d-flex">
            <div class="ml-auto">
                @if(!$task->isCompleted())
                    <form action="/tasks/{{$task->id}}" method="POST" class="d-inline">
                        @method('PATCH')
                        @csrf
                        <button type="submit" class="btn btn-outline-info">Complete</button>
                    </form>
                @endif
                <form action="/tasks/{{$task->id}}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<a href="/tasks/create" class="btn btn-info btn-lg btn-block">New task</a>
@endsection
