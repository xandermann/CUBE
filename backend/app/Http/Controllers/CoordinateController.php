<?php

namespace App\Http\Controllers;

use App\Models\{User, Coordinate};
use Illuminate\Http\Request;

class CoordinateController extends Controller
{
    /**
     * Display a listing of the complaints.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()->coordinate;
    }

}
