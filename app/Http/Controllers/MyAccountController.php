<?php

namespace App\Http\Controllers;

use App\Models\{
    BillingDetails,
    CustomerPersonalInformation,
    Division,
    Order_Deatail,
    Order_Summary,
    User,
};
use Illuminate\Http\Request;
use App\Http\Requests\{
    CustomerPerInfo,
};
use Auth;
use PDF;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isCustomer']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.profile.dashboard');

    }
    public function indexDeliveredOrder()
    {
       return view('frontend.pages.profile.delivered_order',[
            'billings' => BillingDetails::where('user_id',Auth::user()->id)->latest()->paginate(5),
       ]);
    }
    public function downloadInvoice($billing_id)
    {
        $billing_Details = BillingDetails::find($billing_id);
        $order_summary = Order_Summary::where('billing_id',$billing_Details->id)->first();
        $order_details = Order_Deatail::where('order_summary_id',$order_summary->id)->get();
        // return  $order_details;s
        $pdf = PDF::loadView('frontend.pages.profile.invoice', compact('billing_Details','order_details','order_summary'))->setPaper('a4', 'portrait');
        return $pdf->download('invoice.pdf');
    }

    public function indexPersonalOnfo()
    {
        return view('frontend.pages.profile.personal_information',[
            'personalInformation' => CustomerPersonalInformation::where('user_id',Auth::user()->id)->first(),
        ]);
    }

    public function editPersonalOnfo($username)
    {
        // return $username;
        return view('frontend.pages.profile.personal_information_edit',[
            'personalInformation' => CustomerPersonalInformation::where('username',$username)->first(),
            'regions' =>Division::orderBy('name','asc')->get(),
        ]);
    }
    public function updatePersonalOnfo(CustomerPerInfo $request)
    {
        // return $request;
        $request->validate([
            'username' => 'required|unique:customer_personal_information,username,'.$request->personal_information_id,

        ]);
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $CusPerInfo = CustomerPersonalInformation::find($request->personal_information_id);
        $CusPerInfo->username = $request->username;
        $CusPerInfo->mobile = $request->mobile;
        $CusPerInfo->birth_date = $request->birth_date;
        $CusPerInfo->region_id = $request->region_id;
        $CusPerInfo->district_id = $request->district_id;
        $CusPerInfo->upazila_id = $request->upazila_id;
        $CusPerInfo->street_address1 = $request->street_address1;
        $CusPerInfo->street_address2 = $request->street_address2;
        $CusPerInfo->gender = $request->gender;
        $CusPerInfo->save();
        return redirect()->route('my-account.personal.information.edit',$CusPerInfo->username);


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
