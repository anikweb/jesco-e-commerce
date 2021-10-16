<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Models\{
    Category,
    Product,
    Product_Attribute,
    Wishlist,
};
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        if(Cookie::get('jesco_ecommerce') == ''){
            $cookie_name = 'jesco_ecommerce';
            $cookie_value = time().'-'.Str::random(10);
            $cookie_duration = 43200;
            Cookie::queue($cookie_name, $cookie_value, $cookie_duration);
        }
        return view('frontend.home',[
            'productAll' => Product::limit(8)->get(),
            'productNew' => Product::latest()->limit(8)->get(),
            'wishlistProduct' =>Wishlist::all(),
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
    public function wishlistIndex(){

        $siteCookie = Cookie::get('jesco_ecommerce');

        return view('frontend.pages.wishlist',[

            'wishlists' => Wishlist::where('cookie_id',$siteCookie)->latest()->paginate(10),
        ]);
    }
    public function wishliststore($product_id){
            $siteCookie = Cookie::get('jesco_ecommerce');
            $wishlistCheck =  Wishlist::where('cookie_id',$siteCookie)->where('product_id',$product_id)->first();
            if($wishlistCheck){
                $wishlistCheck->delete();
                return response('deleted');
            }else{
                $wishlist = new Wishlist;
                $wishlist->cookie_id =$siteCookie;
                $wishlist->product_id =$product_id;
                $wishlist->save();
                return response()->json($wishlist);

            }


    }
    public function wishlistRemove($id){
        // return $id;
        $siteCookie = Cookie::get('jesco_ecommerce');
        $wishlistCheck =  Wishlist::where('cookie_id',$siteCookie)->where('product_id',$id)->first();
        $wishlistCheck->delete();
        return back()->with('success','Deleted!');
    }
    function getColorSizeId($cid,$pid){
        $sizes = Product_Attribute::where('product_id',$pid)->where('color_id',$cid)->get();
        $outpot = '';
        foreach ($sizes as $key => $size) {
            if($size->size->name != 'none'){
                $outpot =  $outpot.'<input class="sizeCheck @error("size_id") is-invalid @enderror" style="cursor: pointer; width: auto; height:auto" data-rPrice="'.$size->regular_price.'" data-price="'.$size->offer_price.'" data-quantity="'.$size->quantity.'" id="size" type="radio" value="'.$size->size_id.'" name="size_id"><label style="cursor: pointer;" for="size">'.' '. $size->size->name .'</label>';
            }
            if($size->size->name == 'none'){
                $outpot = 'none';
            }
        }
        return response()->json($outpot);
        // echo $outpot;
    }

}
