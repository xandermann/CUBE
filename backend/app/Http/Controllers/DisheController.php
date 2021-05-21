<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dishe;
use Illuminate\Http\Request;

class DisheController extends Controller
{
    /**
     * Affiche les différents plats d'un restaurant.
     *
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Restaurant::findOrFail($id)->dishes()->with('ingredients')->get();
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
}
