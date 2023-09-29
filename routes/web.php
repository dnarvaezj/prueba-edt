<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [RestaurantController::class, 'index'])->name('home');

Route::post('/restaurant/loadcsv', [RestaurantController::class, 'loadCsv'])->name('load_csv');
Route::post('/restaurant/create', [RestaurantController::class, 'create'])->name('create_restaurant');
Route::put('/restaurant/update/{id}', [RestaurantController::class, 'update'])->name('edit_restaurant');
Route::delete('/restaurant/delete/{id}', [RestaurantController::class, 'delete'])->name('delete_restaurant');
