<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Franchise;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['nomRestaurant', 'adresseRestaurant', 'numRestaurant', 'idFranchise'];

    public function franchise() {
        return $this->belongsTo(Franchise::class);
    }
}
