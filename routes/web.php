<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ListTodoController;
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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

Route::middleware(['auth'])->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [TodoController::class, 'index'])->name('dashboard');
    Route::get('/create/todo', [TodoController::class, 'create']);
    Route::post('/store/todo', [TodoController::class, 'store']);
    Route::get('/show/todo/{id}', [TodoController::class, 'show']);
    Route::post('/update/todo/{id}', [TodoController::class, 'update']);
    Route::get('/delete/todo/{id}', [TodoController::class, 'delete']);

    Route::get('/{todoId}/todolist', [ListTodoController::class, 'index'])->name('todolist');
    Route::get('/{todoId}/create/todolist', [ListTodoController::class, 'create'])->name('create.todolist'); 
    Route::post('/{todoId}/store/todolist', [ListTodoController::class, 'store']);
    Route::get('/show/todo/{todoId}/todolist', [ListTodoController::class, 'show']);
    Route::put('/update/todo/{todoId}/todolist', [ListTodoController::class, 'update']);
    Route::get('/delete/todo/{todoId}/todolist', [ListTodoController::class, 'delete']);
    
});

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });

/*Route::get('/todo', [TodoController::class, 'index']);
Route::get('/create/todo', [TodoController::class, 'create']);
Route::post('/store/todo', [TodoController::class, 'store']);
Route::get('/show/todo/{id}', [TodoController::class, 'show']);
Route::post('/update/todo/{id}', [TodoController::class, 'update']);
Route::get('/delete/todo/{id}', [TodoController::class, 'delete']);*/

