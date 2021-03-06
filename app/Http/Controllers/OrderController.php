<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\Order_Summary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderController extends Controller
{


    public function index(){
        if(auth()->user()->can('order management')){
            return view('backend.pages.orders.picup_in_progress',[
                'orders' => Order_Summary::where('current_status',1)->latest()->paginate(10),
            ]);
        }else{
            return abort(404);
        }
    }
    public function upgradeToShipped($invoice_no){
        if(auth()->user()->can('order management')){
            // return $invoice_no;
            $order_summary = Order_Summary::where('invoice_no',$invoice_no)->first();
            $order_summary->current_status = 2;
            $order_summary->save();
            return redirect()->route('dashboard.orders.details',$invoice_no)->with('success','Order '.$invoice_no.' upgraded to shipped');
        }else{
            return abort(404);
        }
    }
    public function indexShipped(){
        if(auth()->user()->can('order management')){
            return view('backend.pages.orders.shipped',[
                'orders' => Order_Summary::where('current_status',2)->latest()->paginate(10),
                ]);
        }else{
            return abort(404);
        }
    }
    public function upgradeToOutForDelivery($invoice_no){
        if(auth()->user()->can('order management')){
            // return $invoice_no;
            $order_summary = Order_Summary::where('invoice_no',$invoice_no)->first();
            $order_summary->current_status = 3;
            $order_summary->save();
            return redirect()->route('dashboard.orders.details',$invoice_no)->with('success','Order '.$invoice_no.' upgraded to out for delivery');;
        }else{
            return abort(404);
        }
    }
    public function indexOutForDelivered(){
        if(auth()->user()->can('order management')){
            return view('backend.pages.orders.out_for_delivered',[
                'orders' => Order_Summary::where('current_status',3)->latest()->paginate(10),
                ]);
        }else{
            return abort(404);
        }
    }
    public function upgradeToDelivered($invoice_no){
        if(auth()->user()->can('order management')){
            // return $invoice_no;
            $order_summary = Order_Summary::where('invoice_no',$invoice_no)->first();
            $order_summary->current_status = 4;
            $order_summary->delivered_date = Carbon::now();
            $order_summary->save();
            return redirect()->route('dashboard.orders.details',$invoice_no)->with('success','Order '.$invoice_no.' upgraded to delivered');;
        }else{
            return abort(404);
        }
    }
    public function indexDelivered(){
        if(auth()->user()->can('order management')){
            return view('backend.pages.orders.delivered',[
                'orders' => Order_Summary::where('current_status',4)->latest()->paginate(10),
            ]);
        }else{
            return abort(404);
        }
    }
    public function indexDetails($invoice_no){
        if(auth()->user()->can('order management')){
            // return $invoice_no;
            return view('backend.pages.orders.details',[
                'order' => Order_Summary::where('invoice_no',$invoice_no)->first(),
            ]);
        }else{
            return abort(404);
        }
    }
    public function cancelOrder($invoice_no){
        if(auth()->user()->can('order management')){
            // return $invoice_no;
            $order_summary = Order_Summary::where('invoice_no',$invoice_no)->first();
            $order_summary->current_status = 5;
            $order_summary->save();
            return redirect()->route('dashboard.orders.details',$invoice_no)->with('success','Order '.$invoice_no.' canceled! ');;
        }else{
            return abort(404);
        }
    }
    public function indexCanceled(){
        if(auth()->user()->can('order management')){
            return view('backend.pages.orders.canceled',[
                'orders' => Order_Summary::where('current_status',5)->latest()->paginate(10),
            ]);
        }else{
            return abort(404);
        }
    }

}
