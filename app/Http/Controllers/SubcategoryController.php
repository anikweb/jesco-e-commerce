<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Subcategory
};
use Illuminate\Http\Request;
use App\Http\Requests\{
    SubcategoryForm,
};
use Illuminate\Support\{
    Str,
};

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('subcategory view')){
            return view('backend.pages.subcategory.index',[
                "subcategories" => Subcategory::latest()->paginate(10),
            ]);
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
        if(auth()->user()->can('subcategory add')){
            return view('backend.pages.subcategory.create',[
                'categories' => Category::orderBy('name','asc')->get(),
            ]);
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
    public function store(SubcategoryForm $request)
    {
        if(auth()->user()->can('subcategory add')){
            $subcategory = new Subcategory;
            $subcategory->name =$request->name;
            $subcategory->slug = Str::slug($request->name);
            $subcategory->category_id =$request->category_id;
            if($subcategory->save()){
                return redirect()->route('subcategory.index')->with('success','Subcategory Created!');
            }else{
                return back()->with('error','Failed!');
            }
        }else{
            return abort(404);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // return $slug;
        if(auth()->user()->can('subcategory edit')){
            return view('backend.pages.subcategory.edit',[
                'categories' =>Category::orderBy('name','asc')->get(),
                'subcategory' =>Subcategory::where('slug',$slug)->first(),
            ]);
        }else{
            return abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        if(auth()->user()->can('subcategory edit')){
            $request->validate([
                "name" => "required|string|max:20|unique:subcategories,name,".$subcategory->id,
                "category_id" => "required|integer",
            ]);

            $subcategory->name = $request->name;
            $subcategory->slug = Str::slug($request->name);
            $subcategory->category_id = $request->category_id;
            if($subcategory->save()){
                return redirect()->route('subcategory.index')->with('success','Subcategory Updated!');
            }else{

            }
        }else{
            return abort(404);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        if(auth()->user()->can('subcategory delete')){
            if($subcategory->delete()){
                return back()->with('success','Subcategory Deleted!');
            }else{
                return back()->with('error','Failed');
            }
        }else{
            return abort(404);
        }


    }
}
