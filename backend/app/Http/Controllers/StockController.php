<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequests\StockPutRequest;
use App\Http\Requests\StockRequests\StockPostRequest;
use App\Http\Requests\StockRequests\StockDeleteRequest;
use App\Models\Restaurant;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Affiche les ingrédients en stock d'un restaurant.
     *
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Restaurant::findOrFail($id)->ingredients()->paginate(10);
    }

    /**
     * Ajoute un ingrédient dans le stock d'un restaurant.
     *
     * @param  \App\Http\Requests\StockRequests\StockPostRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function add_Ingredient(StockPostRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $ingredient = Ingredient::findOrFail($request->ingredient_id);

        if($restaurant && $ingredient) {

            if($restaurant->ingredients()->find($ingredient->id)) {
                abort(409, 'The restaurant has already this ingredient.');
            }

            $restaurant->ingredients()->attach($ingredient, ['quantity' => $request->quantity]);
        }
    }

    /**
     * Ajoute une quantité d'un ingrédient existant dans le stock d'un restaurant.
     *
     * @param  \App\Http\Requests\StockRequests\StockPutRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function add_Quantity(StockPutRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $ingredient = Ingredient::findOrFail($request->ingredient_id);

        if($restaurant && $ingredient) {
            $stock = $restaurant->ingredients()->find($ingredient->id);
            $restaurant->ingredients()->updateExistingPivot($ingredient, ['quantity' => $stock->pivot->quantity + $request->quantity]);
        }
    }

    /**
     * Ajoute un ingrédient dans le stock d'un restaurant.
     *
     * @param  \App\Http\Requests\StockRequests\StockDeleteRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function delete_Ingredient(StockDeleteRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $ingredient = Ingredient::findOrFail($request->ingredient_id);

        if($restaurant && $ingredient) {

            if($restaurant->ingredients()->find($ingredient->id) == null) {
                abort(422, "The restaurant does not have this ingredient in its stock.");
            }

            $restaurant->ingredients()->detach($ingredient);
        }
    }
}