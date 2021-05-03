<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['nomRestaurant', 'adresseRestaurant', 'numRestaurant', 'idFranchise'];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
