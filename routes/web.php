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
    return view('auth.login');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

Route::middleware(['auth'])->group(function () {
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

    Route::get('/{todoId}/show/todolist', [ListTodoController::class, 'show']);
    Route::put('/{todoId}/update/todolist', [ListTodoController::class, 'update']);
    Route::get('/{todoId}/delete/todolist', [ListTodoController::class, 'delete']);
});

require __DIR__ . '/auth.php';

//admin page
Route::middleware(['auth', 'checkRole:1'])->group(function () {
    Route::resource('index-admin', AdminController::class);
});
