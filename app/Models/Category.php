<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function subSubCategory()
    {
        return $this->hasMany(SubSubCategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
