<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Displays all menus.
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
     * A restaurant creates a new menu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        //creation of the menu
        $menu = Menu::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        //dishes related to the menu
        foreach ($request->dishes as $dishe) {
            $menu->dishes()->attach($dishe['id']);
        }

        //restaurant related menu
        $restaurant->menus()->attach($menu);
    }

    /**
     * A restaurant updates a menu it already has.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $menu = Menu::findOrFail($request->menu_id);

        //menu update
        $menu->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        //we remove the old dishes
        $menu->dishes()->detach();

        //we add the new dishes related to the menu
        foreach ($request->dishes as $dishe) {
            $menu->dishes()->attach($dishe['id']);
        }
    }

    /**
     * A restaurant removes one of its menus.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $menu = Menu::findOrFail($request->menu_id);

        if($restaurant->menus()->find($menu->id) == null) {
            abort(422, "The restaurant does not have this menu.");
        }

        $menu->delete();
    }
}
