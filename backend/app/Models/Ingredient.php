<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function restaurants() {
        return $this->belongsToMany(Restaurant::class);
    }
}
