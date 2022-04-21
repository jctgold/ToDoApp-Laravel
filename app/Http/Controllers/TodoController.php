<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TodoController extends Controller
{
    public function index(){

        $task = Task::all();
        return view('index')->with('tasks', $task->sortBy('status'));

    }
  
    public function create(){

        try {
            $this->validate(request(), [
                'name' => ['required'],
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

        $task = new Task();
        //On the left is the field name in DB and on the right is field name in Form/view
        $task->name = $data['name'];
        $task->status = 'pending';
        $task->save();

        session()->flash('Success', 'Created new task.');

        return redirect('/');
    }

    public function updateName(Task $task) {

        $data = request()->all();
        
        try {
            $this->validate(request(), [
                'name' => ['required']
            ]);

        } catch (ValidationException $e) {
            
        }

        $task->name = $data['name'];
        $task->save();
        
        session()->flash('Success', 'Updated task.');
        
        return redirect('/');
    }

    public function updateStatus(Task $task) {

        echo '<script>alert("Welcome to Geeks for Geeks")</script>';
        
        
        try {
            $this->validate(request(), [
                'name' => ['required']
            ]);

        } catch (ValidationException $e) {
            
        }

        $status = 'pending';

        if(request()->has('status')) {
            $status = 'done';
        }

        $task->status = $status;
        $task->save();

        session()->flash('Success', 'updated task.');

        return redirect('/');
    }

    public function delete(Task $task){

        $task->delete();

        return redirect('/');

    }

    public function clearCompleted(Task $task){

        echo '<script>alert("Welcome to Geeks for Geeks")</script>';

        $tasks = Task::all();

        foreach($tasks as $task) {
            if($task['status'] == "done") {
                $task->delete();
            }
        }

        return redirect('/');
    }

}
