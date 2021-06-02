<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
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
}
