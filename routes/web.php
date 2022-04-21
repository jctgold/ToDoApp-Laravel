<?php

use App\Http\Controllers\ToDoController;

Route::get('/', [TodoController::class, 'index']);

Route::get('delete/{task}', [TodoController::class, 'delete']);
Route::get('clear-completed', [TodoController::class, 'clearCompleted']);

Route::post('create-task', [TodoController::class, 'create']);
Route::post('update-status/{task}', [TodoController::class, 'updateStatus']);
Route::post('update-name/{task}', [TodoController::class, 'updateName']);
