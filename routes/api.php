<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ImageCrudController;

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

Route::post('/create',[ImageCrudController::class,'create']);

Route::get('/get', [ImageCrudController::class, 'get']);

Route::patch('/edit/{id}', [ImageCrudController::class, 'edit']);

Route::put('/update/{id}', [ImageCrudController::class, 'update']);