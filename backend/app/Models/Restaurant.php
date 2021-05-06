<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coordinate;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'coordinate_id'];

    public function franchise() {
        return $this->belongsTo(Coordinate::class);
    }
}
