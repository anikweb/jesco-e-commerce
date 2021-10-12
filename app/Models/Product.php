<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function attribute(){
        return $this->hasMany(Product_Attribute::class,'product_id');
    }
    public function imageGallery(){
        return $this->hasMany(ProductImageGallery::class,'product_id');
    }
    public function wishlist(){
        return $this->hasMany(Wishlist::class,'product_id');
    }

}
