<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DisheController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ComplaintController;
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

Route::prefix('restaurants')->group(function () {
    //partie stock
    Route::get('/{restaurant}/stock', [StockController::class, 'index'])->where('restaurant', '[0-9]+');
    Route::post('/{restaurant}/stock', [StockController::class, 'add_Ingredient'])->where('restaurant', '[0-9]+');
    Route::put('/{restaurant}/stock', [StockController::class, 'add_Quantity'])->where('restaurant', '[0-9]+');
    Route::delete('/{restaurant}/stock', [StockController::class, 'delete_Ingredient'])->where('restaurant', '[0-9]+');

    //partie plat
    Route::get('/{restaurant}/dishes', [DisheController::class, 'index_restaurant'])->where('restaurant', '[0-9]+');
    Route::post('/{restaurant}/dishes', [DisheController::class, 'store'])->where('restaurant', '[0-9]+');
    Route::put('/{restaurant}/dishes', [DisheController::class, 'update'])->where('restaurant', '[0-9]+');
    Route::delete('/{restaurant}/dishes', [DisheController::class, 'destroy'])->where('restaurant', '[0-9]+');

    //partie menu
    Route::get('/{restaurant}/menus', [MenuController::class, 'index_restaurant'])->where('restaurant', '[0-9]+');
    Route::post('/{restaurant}/menus', [MenuController::class, 'store'])->where('restaurant', '[0-9]+');
    Route::put('/{restaurant}/menus', [MenuController::class, 'update'])->where('restaurant', '[0-9]+');
    Route::delete('/{restaurant}/menus', [MenuController::class, 'destroy'])->where('restaurant', '[0-9]+');
});

Route::prefix('dishes')->group(function () {
    Route::get('/', [DisheController::class, 'index']);
});

Route::prefix('menus')->group(function () {
    Route::get('/', [MenuController::class, 'index']);
});

Route::prefix('orders')->group(function () {
    Route::get('/{user}', [OrderController::class, 'index_user'])->where('user', '[0-9]+');
    Route::post('/', [OrderController::class, 'store']);
});

Route::prefix('complaints')->group(function () {
    Route::get('/', [ComplaintController::class, 'index']);
    Route::post('/', [ComplaintController::class, 'store']);
});

Route::apiResources([
    'restaurants' => RestaurantController::class,
    'ingredients' => IngredientController::class
    // Autres controlleurs ici
]);
