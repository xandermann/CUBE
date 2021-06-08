<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequests\OrderPostRequest;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Dishe;
use App\Models\Menu;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DisheController;
use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Displays the orders of a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_user($user_id)
    {
        return User::findOrFail($user_id)->orders()->with('dishes')->with('menus')->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Place an order.
     *
     * @param  \App\Http\Requests\OrderRequests\OrderPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderPostRequest $request)
    {
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        // $user = User::findOrFail($request->user_id);
        $user = auth()->user();
        $total_price = 0;
        $ingredients_needed = array();

        //price calculation dishes + get quantity needed for each ingredients
        foreach ($request->dishes as $dishe) {
            $dishe_find = Dishe::find($dishe['id']);

            if(!DisheController::checkIfRestaurantHasAnDishe($restaurant, $dishe_find->id)) {
                abort(422, "The restaurant does not have this dishe.");
            }

            $total_price += ($dishe_find->price) * $dishe['quantity'];

            foreach ($dishe_find->ingredients as $ingredient) {

                if(!StockController::checkIfRestaurantHasAnIngredient($restaurant, $ingredient->id)) {
                    abort(422, "The restaurant does not have this ingredient in its stock.");
                }

                $quantity_needed = ($ingredient->pivot->quantity) * $dishe['quantity'];

                if(array_key_exists($ingredient->id, $ingredients_needed)) {
                    $ingredients_needed[$ingredient->id] += $quantity_needed;
                }
                else {
                    $ingredients_needed[$ingredient->id] = $quantity_needed;
                }
            }
        }

        //price calculation menus + get quantity needed for each ingredients
        foreach ($request->menus as $menu) {
            $menu_find = Menu::find($menu['id']);

            if(!MenuController::checkIfRestaurantHasAnMenu($restaurant, $menu_find->id)) {
                abort(422, "The restaurant does not have this menu.");
            }

            $total_price += ($menu_find->price) * $menu['quantity'];

            foreach ($menu_find->dishes as $dishe) {

                $dishe_find = Dishe::find($dishe->id);

                foreach ($dishe_find->ingredients as $ingredient) {

                    if(!StockController::checkIfRestaurantHasAnIngredient($restaurant, $ingredient->id)) {
                        abort(422, "The restaurant does not have this ingredient in its stock.");
                    }

                    $quantity_needed = ($ingredient->pivot->quantity) * $menu['quantity'];

                    if(array_key_exists($ingredient->id, $ingredients_needed)) {
                        $ingredients_needed[$ingredient->id] += $quantity_needed;
                    }
                    else {
                        $ingredients_needed[$ingredient->id] = $quantity_needed;
                    }
                }
            }
        }

        //we check if the restaurant have enough quantity for all the ingredients needed
        foreach ($ingredients_needed as $ingredient_id => $quantity_needed) {

            $quantity_inStock = $restaurant->ingredients()->find($ingredient_id)->pivot->quantity;

            if($quantity_needed > $quantity_inStock) {
                abort(422, "the restaurant does not have enough ingredients in stock.");
            }

            //the quantity needed for the dishes is deducted from the stock quantity
            $restaurant->ingredients()->updateExistingPivot($ingredient_id, ['quantity' => $quantity_inStock - $quantity_needed]);
        }

        //creation of the order
        $order = Order::create([
            'date' => $request->date,
            'total_price' => $total_price,
            'user_id' => $user->id,
            'restaurant_id' => $restaurant->id
        ]);

        //dishes ordered
        foreach ($request->dishes as $dishe) {
            $order->dishes()->attach($dishe['id'], ['quantity' => $dishe['quantity']]);
        }

        //ordered menus
        foreach ($request->menus as $menu) {
            $order->menus()->attach($menu['id'], ['quantity' => $menu['quantity']]);
        }
    }
}
