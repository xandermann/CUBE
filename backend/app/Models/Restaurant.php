<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coordinate;
use App\Models\Ingredient;

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
}
