@extends('layouts.app')


@section('content')
<h1>New List</h1>
<form method="POST" action="/tasks">
  <div class="form-group">
    @csrf
    <label for="Description">Task Description</label>
    <input class="form-control" name="description"/>
  </div>

  @if($errors->any())
    <div class="alert alert-danger" role="alert">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    </div>
  @endif
  
  <div class="form-group">
    <button type="submit" class="btn btn-outline-primary">Create Task</button>
  </div>
</form>
@endsection