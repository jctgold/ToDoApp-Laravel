<?php

use App\Http\Controllers\ToDoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TodoController::class, 'index']);

Route::get('delete/{task}', [TodoController::class, 'delete']);
Route::get('clear-completed', [TodoController::class, 'clearCompleted']);

Route::post('create-task', [TodoController::class, 'create']);
Route::post('update-status/{task}', [TodoController::class, 'updateStatus']);
Route::post('update-name/{task}', [TodoController::class, 'updateName']);

/*
Route::get('/', function () {
    return view('index', [
        'tasks' => Task::orderBy('created_at', 'asc')->get()
    ]);
});

Route::post('/add', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = new Task;
    $task->name = $request->name;
    $task->status = 'pending';
    $task->save();

    return redirect('/');
});

Route::delete('/delete/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/');
});

Route::post('/update-status/{id}', function ($id) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    alert("successfull");

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    if( $request->has('checkbox-{{$id}}') ){
        $task = new Task;
        $task->name = $request->name;
        $task->status = "done";
        $task->save();

    }else {
        $task = new Task;
        $task->name = $request->name;
        $task->status = "pending";
        $task->save();
    }


    return redirect('/lol');
});

*/
