<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Summary extends Model
{
    use HasFactory;
    public function billing_id(){
        return $this->belongsTo(BillingDetails::class,'billing_id');
    }
    public function order_details(){
        return $this->hasMany(Order_Deatail::class,'order_summary_id');
    }
}
