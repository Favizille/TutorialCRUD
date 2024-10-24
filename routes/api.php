<?php

use App\Http\Controllers\API\TutorialController;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/tutorials', [TutorialController::class, 'index']);
Route::post('/tutorial/create',[TutorialController::class, 'store']);
Route::get('/tutotrial/{id}', [TutorialController::class,'show']);
Route::put('/tutorial/{id}', [TutorialController::class,'update']);
Route::delete('/tutorial/{id}',[TutorialController::class,'destroy']);