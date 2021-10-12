<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(){
        if(auth()->user()->can('wishlist view')){
            $siteCookie = Cookie::get('jesco_ecommerce');
            return view('backend.pages.wishlist',[
                'wishlists' => Wishlist::where('cookie_id',$siteCookie)->latest()->paginate(10),
            ]);
        }else{
            return abort(404);
        }
    }
}
