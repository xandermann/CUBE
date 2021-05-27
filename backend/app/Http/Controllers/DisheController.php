<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dishe;
use Illuminate\Http\Request;

class DisheController extends Controller
{
    /**
     * Affiche tous les plats.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dishe::with('ingredients')->paginate(10);
    }

    /**
     * Affiche les différents plats d'un restaurant.
     *
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function index_restaurant($id)
    {
        return Restaurant::findOrFail($id)->dishes()->with('ingredients')->paginate(10);
    }

    /**
     * Un restaurant crée un nouveau plat.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        if($restaurant) {
            //création du plat
            $dishe = Dishe::create([
                'name' => $request->name,
                'price' => $request->price
            ]);

            //ingrédients liés au plat
            foreach ($request->ingredients as $ingredient) {
                $dishe->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
            }

            //plat lié au restaurant
            $restaurant->dishes()->attach($dishe);
        }
    }

    /**
     * Un restaurant met à jour un plat qu'il possède déjà.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $dishe = Dishe::findOrFail($request->dishe_id);

        if($restaurant && $dishe) {
            //mise à jour du plat
            $dishe->update([
                'name' => $request->name,
                'price' => $request->price
            ]);

            //on retire les anciens ingrédients
            $dishe->ingredients()->detach();

            //on ajoute les nouveaux ingrédients liés au plat
            foreach ($request->ingredients as $ingredient) {
                $dishe->ingredients()->attach($ingredient['id'], ['quantity' => $ingredient['quantity']]);
            }
        }
    }

    /**
     * Un restaurant supprime un de ses plats.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $dishe = Dishe::findOrFail($request->dishe_id);

        if($restaurant->dishes()->find($dishe->id) == null) {
            abort(422, "The restaurant does not have this dishe.");
        }

        $dishe->delete();
    }
}
