<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
