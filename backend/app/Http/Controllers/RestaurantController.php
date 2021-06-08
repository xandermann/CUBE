<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequests\RestaurantPostRequest;
use App\Http\Requests\RestaurantRequests\RestaurantGetRequest;
use App\Models\Restaurant;
use App\Models\Coordinate;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the restaurant.
     *
     * @param  \App\Http\Requests\RestaurantRequests\RestaurantGetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(RestaurantGetRequest $request)
    {
        //get filter parameter
        $note = $request->input('rating');

        if($note) {
            return Restaurant::with('coordinate')
                ->with('ingredients')
                ->where('note', '>=', $note)
                ->paginate(10);
        }
        else {
            return Restaurant::with('coordinate')->with('ingredients')->paginate(10);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequests\RestaurantPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RestaurantPostRequest $request)
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
            'note' => null,
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
        return Restaurant::with('coordinate')->with('ingredients')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RestaurantRequests\RestaurantPostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RestaurantPostRequest $request, $id)
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
