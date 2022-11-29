<?php

namespace App\Models;

use App\Models\ShipState;
use App\Models\ShipDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipDivison extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function district()
    {
        return $this->hasMany(ShipDistrict::class);
    }

    public function state()
    {
        return $this->hasMany(ShipState::class);
    }
}
