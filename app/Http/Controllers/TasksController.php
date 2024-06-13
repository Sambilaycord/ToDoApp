<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function index(){

        $tasks = Task::orderBy('completed_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function incomplete(){
        $incompleteTasks = Task::whereNull('completed_at')
            ->orderBy('id', 'DESC')
            ->get();

        return view('tasks.incomplete', [
            'tasks' => $incompleteTasks,
        ]);
    }

    public function completed(){
        $completedTasks = Task::whereNotNull('completed_at')
            ->orderBy('completed_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->get();

        return view('tasks.completed', [
            'tasks' => $completedTasks,
        ]);
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(){
        request()->validate([
            'description' => 'required|max:255',
        ]);

        Task::create([
            'description' => request('description'),
        ]);

        return redirect('/');
    }

    public function update($id){
        $task = Task::where('id', $id)->first();

        $task->completed_at = now();
        $task->save();

        return redirect('/');
    }

    public function delete($id){
        $task = Task::where('id', $id)->first();

        $task->delete();

        return redirect('/');
        
    }
}
