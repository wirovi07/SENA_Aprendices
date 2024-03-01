<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstructorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('instructores', [InstructorController::class, 'index']);
Route::get('instructores/{id}', [InstructorController::class, 'show']);
Route::post('instructores', [InstructorController::class, 'store']);
Route::put('instructores/{id}', [InstructorController::class, 'update']);
Route::delete('instructores/{id}', [InstructorController::class, 'destroy']);


