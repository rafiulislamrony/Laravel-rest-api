<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/add/friends', [FriendsController::class, 'AddFriends'])->name('index');

Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::get('students/edit/{id}', [StudentController::class, 'edit']);
Route::put('students/edit/{id}', [StudentController::class, 'update']);
Route::delete('students/delete/{id}', [StudentController::class, 'destroy']);
