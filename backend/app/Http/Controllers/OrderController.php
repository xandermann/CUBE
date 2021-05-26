<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Displays the orders of a user.
     *
     * @param  int  $id user
     * @return \Illuminate\Http\Response
     */
    public function index_user($id)
    {
        return User::findOrFail($id)->orders()->with('dishes')->with('menus')->get();
    }

    /**
     * Place an order.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        $user = User::findOrFail($request->user_id);

        //création de la commande
        $order = Order::create([
            'date' => $request->date,
            'total_price' => $request->total_price,
            'user_id' => $user->id,
            'restaurant_id' => $restaurant->id
        ]);

        //plats commandés
        foreach ($request->dishes as $dishe) {
            $order->dishes()->attach($dishe['id'], ['quantity' => $dishe['quantity']]);
        }

        //menus commandés
        foreach ($request->menus as $menu) {
            $order->menus()->attach($menu['id'], ['quantity' => $menu['quantity']]);
        }
    }
}
