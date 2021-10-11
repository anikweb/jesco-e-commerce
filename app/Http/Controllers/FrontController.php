<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Product,
    Product_Attribute,
};
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('frontend.home',[
            'productAll' => Product::limit(8)->get(),
            'productNew' => Product::latest()->limit(8)->get(),
        ]);
    }
    public function productView(){
        return view('frontend.pages.product.product_list',[
            'productAll' => Product::latest()->get(),
            'productLatest' => Product::latest()->paginate(12),
        ]);
    }
    public function productSingle($slug){

        return view('frontend.pages.product.product_single',[
            'product' => Product::where('slug',$slug)->first(),
        ]);
    }
    function getColorSizeId($cid,$pid){
        $sizes = Product_Attribute::where('product_id',$pid)->where('color_id',$cid)->get();
        $outpot = '';
        foreach ($sizes as $key => $size) {
            $outpot =  $outpot.'<input class="sizeCheck @error("size_id") is-invalid @enderror" style="cursor: pointer; width: auto; height:auto" data-rPrice="'.$size->regular_price.'" data-price="'.$size->offer_price.'" data-quantity="'.$size->quantity.'" id="size" type="radio" value="'.$size->size_id.'" name="size_id"><label style="cursor: pointer;" for="size">'.' '. $size->size->name .'</label>';
        }
        return response()->json($outpot);
        // echo $outpot;
    }

}
