<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\PendapatanController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function(){
     //crud data penduduk
     Route::post('/create',[FormController::class,'create']);
     Route::get('/edit/{id}',[FormController::class,'edit']);
     Route::post('/edit/{id}',[FormController::class,'update']);
     Route::get('/delete/{id}',[FormController::class,'delete']);

      //crud penduduk dengan relasi ke penduduks
    Route::post('/create-pendapatan-gudang',[PendapatanController::class,'create']);
    Route::get('/data-pendapatan/{id}',[PendapatanController::class,'getGudang']);
    Route::get('/data-pendapatan/{id}',[PendapatanController::class,'update']);
    Route::get('/delete/{id}',[PendapatanController::class,'delete']);

    Route::get('/logout',[AuthController::class,'logout']);
});


Route::post('/login',[AuthController::class,'login']);