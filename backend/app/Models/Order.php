<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Dishe;
use App\Models\Menu;
use App\Models\Complaint;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'total_price', 'user_id', 'restaurant_id'];
    protected $dates = ['date'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public function dishes() {
        return $this->belongsToMany(Dishe::class)->withPivot('quantity');
    }

    public function menus() {
        return $this->belongsToMany(Menu::class)->withPivot('quantity');
    }

    public function complaints() {
        return $this->hasMany(Complaint::class);
    }
}
