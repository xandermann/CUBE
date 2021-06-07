<?php

namespace App\Http\Controllers;

use App\Models\{Complaint, Order};
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the complaints.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Complaint::paginate(10);
    }

    /**
     * Send a complaint.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        //creation of the complaint
        Complaint::create([
            'message' => $request->message,
            'date' => $request->date,
            'order_id' => $order->id
        ]);
    }
}
