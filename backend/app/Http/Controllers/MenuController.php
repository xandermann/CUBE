<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Affiche tous les menus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Menu::with('dishes')->paginate(10);
    }

    /**
     * Displays the different menus of a restaurant.
     *
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function index_restaurant($id)
    {
        return Restaurant::findOrFail($id)->menus()->with('dishes')->paginate(10);
    }

    /**
     * Un restaurant crée un nouveau menu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        //création du menu
        $menu = Menu::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        //plats liés au menu
        foreach ($request->dishes as $dishe) {
            $menu->dishes()->attach($dishe['id']);
        }

        //menu lié au restaurant
        $restaurant->menus()->attach($menu);
    }
}
