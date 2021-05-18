<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\Dishe;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function restaurants() {
        return $this->belongsToMany(Restaurant::class);
    }

    public function dishes() {
        return $this->belongsToMany(Dishe::class);
    }
}
