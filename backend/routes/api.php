<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StockController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stock/restaurants/{restaurant}', [StockController::class, 'index'])->where('restaurant', '[0-9]+');
Route::post('/stock/restaurants/{restaurant}', [StockController::class, 'add_Ingredient'])->where('restaurant', '[0-9]+');
Route::put('/stock/restaurants/{restaurant}', [StockController::class, 'add_Quantity'])->where('restaurant', '[0-9]+');
Route::delete('/stock/restaurants/{restaurant}', [StockController::class, 'delete_Ingredient'])->where('restaurant', '[0-9]+');

Route::apiResources([
    'restaurants' => RestaurantController::class,
    'ingredients' => IngredientController::class
    // Autres controlleurs ici
]);
