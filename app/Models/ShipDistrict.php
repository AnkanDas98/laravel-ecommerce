<?php

namespace App\Models;

use App\Models\Order;
use App\Models\ShipState;
use App\Models\ShipDivison;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipDistrict extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function divison()
    {
        return $this->belongsTo(ShipDivison::class, 'divison_id', 'id');
    }

    public function state()
    {
        return $this->hasMany(ShipState::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
