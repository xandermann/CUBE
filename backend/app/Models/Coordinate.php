<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    use HasFactory;

    protected $fillable = ['full_address', 'city', 'postal_code', 'lat_address', 'lng_address', 'number_phone', 'country'];
}
