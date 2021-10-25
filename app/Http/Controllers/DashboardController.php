<?php

namespace App\Http\Controllers;

use App\Models\{
    Order_Summary,
    User,
    Product_Attribute,

};
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->roles->first()->name != 'Customer'){
            return view('backend.dashboard',[
                'new_order' => Order_Summary::where('payment_status',1)->get(),
                'users' =>User::all(),
            ]);
        }else{
            return redirect()->route('frontend');
        }
    }
    function getColorSizeId($cid,$pid){
        $sizes = Product_Attribute::where('product_id',$pid)->where('color_id',$cid)->get();
        $outpot = '';
        foreach ($sizes as $key => $size) {
            $outpot =  $outpot.'<label class="btn btn-default text-center"><input class="sizeCheck" data-ofrPrice="'.$size->offer_price.'" data-rprice="'.$size->regular_price.'" type="radio" name="color_option" id="color_option_b1" autocomplete="off"><span class="text-xl">'.$size->size_id.'</span><br></label>';
            // $outpot = $size->size_id;
        }
        // rPrice

        return response()->json($outpot);
    }
}
