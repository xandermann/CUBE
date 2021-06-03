<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintRequests\ComplaintPostRequest;
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
     * @param  \App\Http\Requests\ComplaintRequests\ComplaintPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintPostRequest $request)
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
