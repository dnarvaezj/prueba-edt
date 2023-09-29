<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

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

Route::post('/restaurant-api/loadcsv', [RestaurantController::class, 'loadCsv'])->name('load_csv_api');
Route::post('/restaurant-api/create', [RestaurantController::class, 'create'])->name('create_restaurant_api');
Route::put('/restaurant-api/update/{id}', [RestaurantController::class, 'update'])->name('edit_restaurant_api');
Route::delete('/restaurant-api/delete/{id}', [RestaurantController::class, 'delete'])->name('delete_restaurant_api');
