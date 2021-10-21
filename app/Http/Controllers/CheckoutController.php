<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    BillingInfoAdd,
};
use App\Mail\CheckoutConfirmation;
use Illuminate\Support\Facades\{
    Cookie,
    Mail,
};
use Illuminate\Http\Request;
use App\Models\{
    BillingDetails,
    Checkout,
    District,
    Division,
    Order_Deatail,
    Order_Summary,
    Upazila,
    Cart,
    CustomerPersonalInformation,
    Product_Attribute,
    Voucher,
};
use Auth;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isCustomer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return session('s_subtotal');
        // if(session('s_subtotal')){
        //     return 'ase';
        // }else{
        //     return 'nai';
        // }

        if(session('s_subtotal')){
            return view('frontend.pages.checkout',[
                'divisions' => Division::orderBy('name','asc')->get(),
                'cusPerInfo' => CustomerPersonalInformation::where('user_id',Auth::user()->id)->first(),
            ]);
        }else{
            return back();
        }
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
    public function store(BillingInfoAdd $request)
    {
        // return session()->all();
        // return Auth::user()->id;
        // return $request;
        // return $cookieId = Cookie::get('jesco_ecommerce');
        $billing_details = new BillingDetails;
        $billing_details->user_id = Auth::user()->id;
        $billing_details->name = $request->name;
        $billing_details->company = $request->company;
        $billing_details->phone = $request->phone;
        $billing_details->email = $request->email;
        $billing_details->region_id = $request->region_id;
        $billing_details->district_id = $request->district_id;
        $billing_details->upazila_id = $request->upazila_id;
        $billing_details->street_adress1 = $request->street_address1;
        $billing_details->street_adress2 = $request->street_address2;
        $billing_details->zip_code = $request->zip_code;
        $billing_details->note = $request->note;
        $billing_details->payment_method = $request->payment_method;
        $billing_details->save();
        // Order Summary
        $order_summary = new Order_Summary;
        $order_summary->billing_id = $billing_details->id;
        $order_summary->shipping_fee = 20;
        $order_summary->sub_total = session()->get('s_subtotal');
        if(session()->get('s_voucher')){
            $order_summary->voucher_name = session()->get('s_voucher');
            $order_summary->discount = session()->get('s_discount');
            $order_summary->total_price = (session()->get('s_subtotal') - session()->get('s_discount')) + 20;
        }else{
            $order_summary->total_price = session()->get('s_subtotal') + 20;
        }
        $order_summary->invoice_no = 'BK'.'-'.uniqid();
        $order_summary->save();
        if(session()->get('s_voucher')){
            Voucher::where('name',session()->get('s_voucher'))->decrement('limit');
        }
        $cookieId = Cookie::get('jesco_ecommerce');
        foreach (Cart::where('cookie_id',$cookieId)->get() as $key => $cart) {
            $order_detail = new Order_Deatail;
            $order_detail->order_summary_id = $order_summary->id;
            $order_detail->product_id = $cart->product_id;
            $order_detail->color_id = $cart->color_id;
            $order_detail->size_id = $cart->size_id;
            $order_detail->quantity = $cart->quantity;
            $order_detail->save();
            Product_Attribute::where([
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
            ])->decrement('quantity',$cart->quantity);
            $cart->delete();
        }
        if($request->email){
            Mail::to($request->email)->send(new CheckoutConfirmation($request));
        }
        return redirect()->route('frontend');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(BillingDetails $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
    //Getting District by ajax for checkout billing
    public function getDistrict($division_id)
    {
        $district = District::where('division_id',$division_id)->get();
        return response()->json($district);
    }
    //Getting Upazila by ajax for checkout billing
    public function getUpazila($district_id)
    {
        $upazila = Upazila::where('district_id',$district_id)->get();
        return response()->json($upazila);
    }
}
