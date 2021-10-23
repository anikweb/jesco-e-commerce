<?php
    function cartsItem(){
        return  App\Models\Cart::where('cookie_id',Cookie::get('jesco_ecommerce'))->get();
    }
    function wishlistItem(){
        return  App\Models\Wishlist::where('cookie_id',Cookie::get('jesco_ecommerce'))->get();
    }
    function basicSettings(){
        return App\Models\BasicSetting::first();
    }

?>
