<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;

class Dishe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
    }
}
