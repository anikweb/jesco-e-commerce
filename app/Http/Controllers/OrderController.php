<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('backend.pages.orders',[
            'billings' => BillingDetails::latest()->paginate(10),
        ]);
    }
}
