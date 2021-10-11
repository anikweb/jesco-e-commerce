<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\{
    Category,
    Product,
    Product_Attribute,
    ProductColor,
    ProductImageGallery,
    ProductReturn,
    ProductSize,
    productWarranty,
    Subcategory,
};
use App\Http\Requests\{
    ProductAddForm,
    ProductEditForm,
};
use Intervention\Image\Facades\{
    Image,
};


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('product view')){
            return view('backend.pages.products.index',[
                'products' =>Product::latest()->paginate(10),
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
        if(auth()->user()->can('product add')){
            return view('backend.pages.products.create',[
                'categories' =>Category::orderBy('name','asc')->get(),
                'warranties' => productWarranty::latest()->get(),
                'returns' => ProductReturn::all(),
                'colors' =>ProductColor::orderBy('name','asc')->get(),
                'sizes' =>ProductSize::orderBy('name','asc')->get(),
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
    public function store(ProductAddForm $request)
    {

        if(auth()->user()->can('product add')){
            $product = new Product;
            $product->name =  $request->name;
            // $product->slug = Str::slug($request->name);
            $slugName  = Str::slug($request->name);
            if(Product::where('slug',$slugName)->first()){
                $product->slug = $slugName.'-'.time();
            }else{
                $product->slug = $slugName;
            }
            $product->thumbnail = 'default.jpg';
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand = $request->brand;
            $product->main_upper_material = $request->main_upper_material;
            $product->outsole_material = $request->outsole_material;
            $product->gender = $request->gender;
            $product->summary = $request->summary;
            $product->description =  $request->description;
            $product->sku = Str::title(uniqid());
            $product->origin = $request->origin;
            $product->warranty = $request->warranty;
            $product->return = $request->return;
            $product->authentic =$request->authentic;
            $product->promotions = $request->promotions;
            $product->save();

            if($request->hasFile('thumbnail')){
                $thumbnail = $request->file('thumbnail');
                $newThumbnailName = Str::slug($product->name).'-'.date('Y_m_d').'.'.$thumbnail->getClientOriginalExtension();
                // Create Dynamic Folder Start
                $path = public_path('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/';
                File::makeDirectory($path, $mode = 0777, true, true);
                // Create Dynamic Folder End
                Image::make($thumbnail)->save($path.$newThumbnailName,80);
                $product->thumbnail = $newThumbnailName;
                $product->save();
            }
            if($request->hasFile('image_galleries')){
                // return 'ase';
                foreach($request->file('image_galleries') as $key => $imageGalleries) {
                    $imageGalleryDB = new ProductImageGallery;
                    $newImageGalleriesName = Str::slug($product->name).'-'.date('Y_m_d').$key.'.'.$imageGalleries->getClientOriginalExtension();
                    // Create Dynamic Folder Start
                    $path1 = public_path('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/';
                    File::makeDirectory($path1, $mode = 0777, true, true);
                    // Create Dynamic Folder End
                    Image::make($imageGalleries)->save($path1.$newImageGalleriesName,80);
                    $imageGalleryDB->product_id = $product->id;
                    $imageGalleryDB->name = $newImageGalleriesName;
                    $imageGalleryDB->save();
                }
            }
            foreach ($request->rPrice as $key => $rPrice) {
                $productAttribute = new Product_Attribute;
                $productAttribute->product_id = $product->id;
                $productAttribute->color_id = $request->color[$key];
                $productAttribute->size_id =  $request->size[$key];
                $productAttribute->regular_price = $rPrice;
                $productAttribute->offer_price = $request->ofrPrice[$key];
                $productAttribute->quantity = $request->quantities[$key];
                $productAttribute->save();
            }
            return redirect()->route('product.index')->with('success','Product Added');
        }else{
            return abort(404);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if(auth()->user()->can('product view')){
            return view('backend.pages.products.show',[
               'product' => Product::where('slug',$slug)->first(),

            ]);
        }else{
            return abort(404);
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if(auth()->user()->can('product edit')){
            return view('backend.pages.products.edit',[
                'product' =>Product::where('slug',$slug)->first(),
                'categories' =>Category::orderBy('name','asc')->get(),
                'warranties' => productWarranty::latest()->get(),
                'returns' => ProductReturn::all(),
                'colors' =>ProductColor::orderBy('name','asc')->get(),
                'sizes' =>ProductSize::orderBy('name','asc')->get(),
            ]);
        }else{
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductEditForm $request, Product $product)
    {
        if(auth()->user()->can('product edit')){
            $product->name =  $request->name;
            $slugName  = Str::slug($request->name);
            if(Product::where('slug',$slugName)->first()){
                $product->slug = $slugName.'-'.time();
            }else{
                $product->slug = $slugName;
            }
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand = $request->brand;
            $product->main_upper_material = $request->main_upper_material;
            $product->outsole_material = $request->outsole_material;
            $product->gender = $request->gender;
            $product->summary = $request->summary;
            $product->description =  $request->description;
            $product->origin = $request->origin;
            $product->warranty = $request->warranty;
            $product->return = $request->return;
            $product->authentic =$request->authentic;
            $product->promotions = $request->promotions;
            $product->sku = uniqid();
            $product->save();
            if($request->hasFile('thumbnail')){
                $oldImage = asset('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail;
                if(file_exists($oldImage)){
                    unlink($oldImage);

                }
                $thumbnail = $request->file('thumbnail');
                $newThumbnailName = Str::slug($product->name).'-'.date('Y_m_d').'.'.$thumbnail->getClientOriginalExtension();
                // Create Dynamic Folder Start
                $path = public_path('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/';
                File::makeDirectory($path, $mode = 0777, true, true);
                // Create Dynamic Folder End
                Image::make($thumbnail)->save($path.$newThumbnailName,80);
                $product->thumbnail = $newThumbnailName;
                $product->save();
            }
            if($request->attrId == [null]){
                foreach ($product->attribute as $attribute) {
                    $attribute->delete();
                }
            }else{
                foreach ($product->attribute as $attribute) {
                    $arraySearch = in_array($attribute->id,$request->attrId);
                    if($arraySearch != 1){
                        $attribute->delete();
                    }
                }
            }
            foreach($request->attrId as $key => $attrId){
                if($attrId !=''){
                    $attr = Product_Attribute::findOrFail($attrId);
                    $attr->product_id = $product->id;
                    $attr->color_id = $request->color[$key];
                    $attr->size_id= $request->size[$key];
                    $attr->regular_price = $request->rPrice[$key];
                    $attr->offer_price = $request->ofrPrice[$key];
                    $attr->quantity = $request->quantity[$key];
                    $attr->save();
                }else{
                    $attr = new Product_Attribute;
                    $attr->product_id = $product->id;
                    $attr->color_id = $request->color[$key];
                    $attr->size_id = $request->size[$key];
                    $attr->regular_price = $request->rPrice[$key];
                    $attr->offer_price = $request->ofrPrice[$key];
                    $attr->quantity = $request->quantity[$key];
                    $attr->save();
                }
            }
            return redirect()->route('product.edit',$product->slug)->with('success','Updated');
        }else{
            return abort(404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function getSubcategory($cat_id)
    {
        $subcategory = Subcategory::where('category_id',$cat_id)->get();
        return response()->json($subcategory);
    }
    public function productImageGallary($slug)
    {
        if(auth()->user()->can('product view')){
            return view('backend.pages.products.image_gallery',[
                'product' => Product::where('slug',$slug)->first(),
            ]);
        }else{
            return abort(404);
        }
    }
    public function productImageGallaryPost(Request $request)
    {
        if(auth()->user()->can('product edit')){
            if($request->hasFile('imageGalleries')){
                // return 'ase';
                // return 'ase';
                foreach($request->file('imageGalleries') as $key => $imageGalleries) {

                    $product = Product::find($request->product_id);
                    $imageGalleryDB = new ProductImageGallery;

                    $newImageGalleriesName = Str::slug($product->name).'-'.date('Y_m_d').Str::random(5).'.'.$imageGalleries->getClientOriginalExtension();
                    // Create Dynamic Folder Start
                    $path1 = public_path('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/';
                    File::makeDirectory($path1, $mode = 0777, true, true);
                    // Create Dynamic Folder End
                    Image::make($imageGalleries)->save($path1.$newImageGalleriesName,80);
                    $imageGalleryDB->product_id = $product->id;
                    $imageGalleryDB->name = $newImageGalleriesName;
                    $imageGalleryDB->save();
                }
                return back()->with('success','Image Added!');
            }else{
                return back()->with('error','failed');
            }
        }else{
            return abort(404);
        }
    }
    public function productImageGallaryDelete($id)
    {
        if(auth()->user()->can('product delete')){
            $imageGallery = ProductImageGallery::find($id);
            $product = Product::find($imageGallery->product_id);
            $oldImage = public_path('assets/images/product').'/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/'.$imageGallery->name;
            if($oldImage){
                unlink($oldImage);
            }
            // unlink($oldImage);
            $imageGallery->delete();
            return back();
        }else{
            return abort(404);
        }
    }
    public function productStockout($id){
        if(auth()->user()->can("product delete")){
            // return $id;
            $productAttrs = Product_Attribute::where('product_id',$id)->get();
         
            foreach ($productAttrs as  $productAttr) {
                echo $productAttr->quantity = 0;
                echo $productAttr->save();
            }

        }
    }
}
