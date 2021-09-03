<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('v1/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('v1/forgot', [App\Http\Controllers\API\AuthController::class, 'forgot']);
Route::post('v1/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('v1/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('v1/todos',[App\Http\Controllers\API\TodoController::class,'index']);
    Route::post('v1/todos',[App\Http\Controllers\API\TodoController::class,'store']);
    Route::get('v1/todos/{id}',[App\Http\Controllers\API\TodoController::class,'show']);
    Route::put('v1/todos/{id}',[App\Http\Controllers\API\TodoController::class,'update']);
    Route::delete('v1/todos/{id}',[App\Http\Controllers\API\TodoController::class,'destroy']);
});
