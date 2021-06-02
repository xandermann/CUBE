<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dishe;
use App\Models\Restaurant;
use App\Models\Order;

class Menu extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'price'];

    public function dishes() {
        return $this->belongsToMany(Dishe::class);
    }

    public function restaurants() {
        return $this->belongsToMany(Restaurant::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
