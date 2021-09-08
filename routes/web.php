<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/todo', [TodoController::class, 'index']);
Route::get('/create/todo', [TodoController::class, 'create']);
Route::post('/store/todo', [TodoController::class, 'store']);
Route::get('/show/todo/{id}', [TodoController::class, 'show']);
Route::post('/update/todo/{id}', [TodoController::class, 'update']);
Route::get('/delete/todo/{id}', [TodoController::class, 'delete']);

//admin page
Route::resource('index-admin', AdminController::class);
Route::put('editProfile/{id}', [AdminController::class, 'update'])->name('editProfile');
Route::put('editPassword/{id}', [AdminController::class, 'changePassword'])->name('editPassword');