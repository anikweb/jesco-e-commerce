<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Deatail extends Model
{
    use HasFactory;
    public function order_summary(){
        return $this->belongsTo(Order_Summary::class,'order_summary_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
