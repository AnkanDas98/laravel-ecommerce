<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Models\MultiImage;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function subSubCategory()
    {
        return $this->belongsTo(SubSubCategory::class, 'subsubcategory_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(MultiImage::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }


    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}
