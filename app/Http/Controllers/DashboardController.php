<?php

namespace App\Http\Controllers;

use App\Models\{
    Order_Summary,
    User,

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
}
