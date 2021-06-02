<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'date', 'order_id'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
