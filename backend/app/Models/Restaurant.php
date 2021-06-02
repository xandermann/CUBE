<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coordinate;
use App\Models\Ingredient;
use App\Models\Dishe;
use App\Models\Menu;
use App\Models\Order;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'coordinate_id'];

    public function coordinate() {
        return $this->belongsTo(Coordinate::class);
    }

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
    }

    public function dishes() {
        return $this->belongsToMany(Dishe::class);
    }

    public function menus() {
        return $this->belongsToMany(Menu::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
