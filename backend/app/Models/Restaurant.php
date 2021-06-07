<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Coordinate, Ingredient, Dishe, Menu, Order, User};

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

    public function users() {
        return $this->belongsToMany(User::class)->withPivot('note','message');
    }
}
