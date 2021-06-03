<?php

namespace App\Http\Controllers;

use App\Models\{Restaurant, User};
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Displays all reviews for a restaurant.
     *
     * @param  int  $id restaurant
     * @return \Illuminate\Http\Response
     */
    public function index_restaurant($id)
    {
        return Restaurant::findOrFail($id)->users()->paginate(10);
    }

    /**
     * Displays all the reviews of a user.
     *
     * @param  int  $id user
     * @return \Illuminate\Http\Response
     */
    public function index_user($id)
    {
        return User::findOrFail($id)->restaurants()->paginate(10);
    }

    /**
     * A user adds a review on a restaurant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        $user->restaurants()->attach($restaurant, ['note' => $request->note, 'message' => $request->message]);

        //the note of the restaurant must be updated
        $final_note = 0;
        $sum_note = 0;
        foreach($restaurant->users as $review) {
            $sum_note += $review->pivot->note;
        }

        if($sum_note != 0) {
            $final_note = $sum_note / $restaurant->users()->count();
        }

        $restaurant->note = $final_note;
        $restaurant->save();
    }
}
