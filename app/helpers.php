<?php
    function cartsItem(){
        return  App\Models\Cart::where('cookie_id',Cookie::get('jesco_ecommerce'))->get();
    }

?>