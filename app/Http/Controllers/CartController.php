<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($voucher = '')
    {
        if($voucher != ''){
            if(!Voucher::where('name',$voucher)->exists()){
                return back()->with('error','Voucher is not exists');
            }
            $voucher = Voucher::where('name',$voucher)->first();
            $currentDate = Carbon::today()->format('Y-m-d');
            if($voucher->expiry_date < $currentDate){
                return back()->with('error','Voucher already expired');
            }
            if($voucher->limit < 1){
                return back()->with('error','Voucher ends of limit');
            }
        }
        $cookieId = Cookie::get('jesco_ecommerce');
        return view('frontend.pages.cart.index',[
            'carts' =>Cart::where('cookie_id',$cookieId)->get(),
            'voucher' => $voucher,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return ;
        if($request->size_id){
            $cookie_id = Cookie::get('jesco_ecommerce');
            if(Cart::where('cookie_id',$cookie_id)->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
                Cart::where('cookie_id',$cookie_id)->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
                return redirect()->route('cart.index')->with('success','Cart Added!');
            }else{
                Cart::create($request->except('_tocken')+[
                    'cookie_id' => $cookie_id,
                ]);
                return redirect()->route('cart.index')->with('success','Cart Added!');
            }
        }else{
            $cookie_id = Cookie::get('jesco_ecommerce');
        if(Cart::where('cookie_id',$cookie_id)->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',7)->exists()){
                Cart::where('cookie_id',$cookie_id)->where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',7)->increment('quantity',$request->quantity);
                return redirect()->route('cart.index')->with('success','Cart Added!');
            }else{
                Cart::create($request->except('_tocken')+[
                    'cookie_id' => $cookie_id,
                    'size_id' => 7,
                ]);
                return redirect()->route('cart.index')->with('success','Cart Added!');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        return $cart;
    }
    public function cartDelete($cart_id)
    {
        Cart::where('cookie_id',Cookie::get('jesco_ecommerce'))->find($cart_id)->delete();
        return back();
    }
    public function cartDeleteAll()
    {
        // return 'hello';
        $carts = Cart::where('cookie_id',Cookie::get('jesco_ecommerce'))->get();
        foreach ($carts as  $cart) {
           $cart->delete();
        }
        return back();
    }
    public function cartRemoveVoucher()
    {
        session()->forget('s_discount');
        session()->forget('s_voucher');
        return redirect()->route('cart.index');
    }
}
