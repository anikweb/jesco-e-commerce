<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\Checkout;
use App\Models\Order_Summary;
use Illuminate\Http\Request;
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
        return view('frontend.pages.checkout');
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
        // return $request;
        // return Auth::user()->id;
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
        if($billing_details->save()){
            Order_Summary
        }

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
}
