<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\User;

class Coordinate extends Model
{
    use HasFactory;

    protected $fillable = ['full_address', 'city', 'postal_code', 'lat_address', 'lng_address', 'number_phone', 'country'];

    public function restaurant() {
        return $this->hasOne(Restaurant::class);
    }
    
    public function user() {
        return $this->hasOne(User::class);
    }
}
