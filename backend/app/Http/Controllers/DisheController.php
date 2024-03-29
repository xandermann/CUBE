<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisheRequests\DishePutRequest;
use App\Http\Requests\DisheRequests\DishePostRequest;
use App\Http\Requests\DisheRequests\DisheDeleteRequest;
use App\Models\Restaurant;
use App\Models\Dishe;
use Illuminate\Http\Request;

class DisheController extends Controller
{
    /**
     * Displays all dishes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dishe::with('ingredients')->paginate(10);
    }

    /**
     * Display the different dishes of a restaurant.
     *
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function index_restaurant($id)
    {
        return Restaurant::findOrFail($id)->dishes()->with('ingredients')->paginate(10);
    }

    /**
     * A restaurant creates a new dish.
     *
     * @param  \App\Http\Requests\DisheRequests\DishePostRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function store(DishePostRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        //creation of the dish
        $dishe = Dishe::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        //ingredients related to the dish
        foreach ($request->ingredients as $ingredient) {
            $dishe->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
        }

        //dish related to the restaurant
        $restaurant->dishes()->attach($dishe);
    }

    /**
     * A restaurant updates a dish it already has.
     *
     * @param  \App\Http\Requests\DisheRequests\DishePutRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(DishePutRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $dishe = Dishe::findOrFail($request->dishe_id);

        if(!$this->checkIfRestaurantHasAnDishe($restaurant, $dishe->id)) {
            abort(422, "The restaurant does not have this dishe.");
        }

        //update of the dish
        $dishe->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        //we remove the old ingredients
        $dishe->ingredients()->detach();

        //we add the new ingredients related to the dish
        foreach ($request->ingredients as $ingredient) {
            $dishe->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
        }
    }

    /**
     * A restaurant removes one of its dishes.
     *
     * @param  \App\Http\Requests\DisheRequests\DisheDeleteRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(DisheDeleteRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $dishe = Dishe::findOrFail($request->dishe_id);

        if(!$this->checkIfRestaurantHasAnDishe($restaurant, $dishe->id)) {
            abort(422, "The restaurant does not have this dishe.");
        }

        $dishe->delete();
    }

    /**
     * Check if the restaurant has an dishe.
     *
     * @param  App\Models\Restaurant  $restaurant
     * @param  int  $dishe_id
     * @return boolean
     */
    public static function checkIfRestaurantHasAnDishe($restaurant, $dishe_id)
    {
        return $restaurant->dishes()->find($dishe_id) != null;
    }

    /**
     * Check if the dishe has an ingredient.
     *
     * @param  App\Models\Dishe  $dishe
     * @param  int  $ingredient_id
     * @return boolean
     */
    public function checkIfDisheHasAnIngredient($dishe, $ingredient_id)
    {
        return $dishe->ingredients()->find($ingredient_id) != null;
    }
}
