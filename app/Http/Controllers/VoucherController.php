<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\{
    Voucher,
};
use Illuminate\Http\Request;
use App\Http\Requests\{
    VoucherAddForm,
};
class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('voucher actives view')){
            return view('backend.pages.voucher.index',[
                'vouchers' => Voucher::latest()->where('status',1)->paginate(10),
            ]);
        }else{
            return abort(404);
        }
    }

    public function voucherDeactivatedList()
    {
        if(auth()->user()->can('voucher deactivates view')){
            return view('backend.pages.voucher.deactivated_voucher',[
                'vouchers' => Voucher::latest()->where('status',2)->paginate(10),
            ]);
        }else{
            return abort(404);
        }
    }
    public function voucherActive($id)
    {
        if(auth()->user()->can('voucher active')){
            $voucher = Voucher::find($id);
            $voucher->status = 1;
            $voucher->save();
            return back()->with('success','\''.$voucher->name.'\''.' Voucher Activate!');
        }else{
            return abort(404);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->can('voucher add')){
            return view('backend.pages.voucher.create');
        }else{
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherAddForm $request)
    {

        if(auth()->user()->can('voucher add')){
            $voucher = Voucher::create($request->except('_token')+[
                'slug' => Str::slug($request->name),
            ]);
            return redirect()->route('voucher.index')->with('success','\''.$voucher->name.'\' Added!');
        }else{
            return abort(404);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if(auth()->user()->can('voucher edit')){
            return view('backend.pages.voucher.edit',[
                'voucher' => Voucher::where('slug',$slug)->first(),
            ]);
        }else{
            return abort(404);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        if(auth()->user()->can('voucher edit')){
            $voucher->name = $request->name;
            $voucher->slug = Str::slug($request->name);
            $voucher->discount = $request->discount;
            $voucher->expiry_date = $request->expiry_date;
            $voucher->limit = $request->limit;
            $voucher->min_checkout_price = $request->min_checkout_price;
            if($voucher->save()){
                return redirect()->route('voucher.edit',$voucher->slug)->with('success','\''.$voucher->name.'\' Updated!');
            }else{
                return redirect()->route('voucher.edit',$voucher->slug)->with('error','Failed!');
            }
        }else{
            return abort(404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        if(auth()->user()->can('voucher trash')){
            if($voucher->delete()){
                return back()->with('success','Voucher Moved to Trash');
            }else{
                return back()->with('error','Failed!');
            }
        }else{
            return abort(404);
        }


    }
    public function voucherDeactivate($id)
    {
        if(auth()->user()->can('voucher deactivate')){
            $voucher = Voucher::find($id);
            $voucher->status = 2;
            $voucher->save();
            return back()->with('success','\''.$voucher->name.'\''.' Voucher Deactivated!');
        }else{
            return abort(404);
        }


    }
}
