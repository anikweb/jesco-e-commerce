<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryForm;
use Illuminate\Http\Request;
use App\Models\{
    Category,
};
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\{
    Str,
};

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can("category view")){
            return view('backend.pages.category.index',[
                'categories' =>Category::latest()->paginate(10),
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
        if(auth()->user()->can("category add")){
            return view('backend.pages.category.create');
        }else{
            return abort(4054);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryForm $request)
    {
        if(auth()->user()->can("category add")){
            $category = new Category;
            $category->name =$request->name;
            $category->slug = Str::slug($request->name);
            if($category->save()){
                return back()->with('success','Category Created!');
            }else{
                return back()->with('success','Category Created!');
            }
        }else{
            return abort(4054);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if(auth()->user()->can("category edit")){
            return view('backend.pages.category.edit',[
               'category' => Category::where('slug',$slug)->first(),
            ]);
        }else{
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validation
        if(auth()->user()->can("category edit")){
            $request->validate([
                "name" => 'required|string|max:20|unique:categories,name,'.$category->id,
            ]);
            // Update
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);

            // Redirect
            if($category->save()){
                return redirect()->route('category.edit',$category->slug)->with('success','Category Updated!');
            }else{
                return back()->with('error','Failed');
            }
        }else{
            return abort(404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        if(auth()->user()->can("category delete")){
            $category = Category::where('slug',$slug)->first();
            if($category->delete()){
                return back()->with('success','Category Deleted!');
            }else{
                return back()->with('error','Failed!');
            }
        }else{
            return abort(404);
        }
    }
}
