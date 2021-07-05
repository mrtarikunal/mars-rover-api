<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlateauController;
use App\Http\Controllers\Api\RoverController;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('/plateau', [PlateauController::class, 'createPlateau']);
Route::get('/plateau/{id}', [PlateauController::class, 'getPlateau']);

Route::post('/rover', [RoverController::class, 'createRover']);
Route::get('/rover/{id}', [RoverController::class, 'getRover']);
Route::get('/rover-state/{id}', [RoverController::class, 'getRoverState']);
Route::post('/move-rover/{id}', [RoverController::class, 'moveRover']);

