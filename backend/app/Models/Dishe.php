<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Order;

class Dishe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
    }

    public function restaurants() {
        return $this->belongsToMany(Restaurant::class);
    }

    public function menus() {
        return $this->belongsToMany(Menu::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}
