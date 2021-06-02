<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequests\MenuPutRequest;
use App\Http\Requests\MenuRequests\MenuPostRequest;
use App\Http\Requests\MenuRequests\MenuDeleteRequest;
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
     * @param  \App\Http\Requests\MenuRequests\MenuPostRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function store(MenuPostRequest $request, $id)
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
     * @param  \App\Http\Requests\MenuRequests\MenuPutRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(MenuPutRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $menu = Menu::findOrFail($request->menu_id);

        if(!$this->checkIfRestaurantHasAnMenu($restaurant, $menu->id)) {
            abort(422, "The restaurant does not have this menu.");
        }

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
     * @param  \App\Http\Requests\MenuRequests\MenuDeleteRequest  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuDeleteRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $menu = Menu::findOrFail($request->menu_id);

        if(!$this->checkIfRestaurantHasAnMenu($restaurant, $menu->id)) {
            abort(422, "The restaurant does not have this menu.");
        }

        $menu->delete();
    }

    /**
     * Check if the restaurant has an menu.
     *
     * @param  App\Models\Restaurant  $restaurant
     * @param  int  $menu_id
     * @return boolean
     */
    public static function checkIfRestaurantHasAnMenu($restaurant, $menu_id)
    {
        return $restaurant->menus()->find($menu_id) != null;
    }

    /**
     * Check if the menu has an dishe.
     *
     * @param  App\Models\Menu  $menu
     * @param  int  $dishe_id
     * @return boolean
     */
    public function checkIfMenuHasAnDishe($menu, $dishe_id)
    {
        return $menu->dishes()->find($dishe_id) != null;
    }
}
