<?php

namespace App\Models;

use App\Models\ShipDivison;
use App\Models\ShipDistrict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function divison()
    {
        return $this->belongsTo(ShipDivison::class, 'divison_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }
}
