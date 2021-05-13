<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use App\Models\Coordinate;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Restaurant::with('coordinate')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantRequest $request)
    {
        $coordinate = Coordinate::create([
            'full_address' => $request->full_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'lat_address' => $request->lat_address,
            'lng_address' => $request->lng_address,
            'number_phone' => $request->number_phone,
            'country' => $request->country
        ]);

        Restaurant::create([
            'name' => $request->name,
            'coordinate_id' => $coordinate->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Restaurant::with('coordinate')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RestaurantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->coordinate()->update([
            'full_address' => $request->full_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'lat_address' => $request->lat_address,
            'lng_address' => $request->lng_address,
            'number_phone' => $request->number_phone,
            'country' => $request->country
        ]);
        $restaurant->update([
            'name' => $request->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->coordinate()->delete();
        $restaurant->delete();
    }
}
