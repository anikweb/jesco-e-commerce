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
        return view('backend.pages.products.index',[
            'products' =>Product::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.products.create',[
            'categories' =>Category::orderBy('name','asc')->get(),
            'warranties' => productWarranty::latest()->get(),
            'returns' => ProductReturn::all(),
            'colors' =>ProductColor::orderBy('name','asc')->get(),
            'sizes' =>ProductSize::orderBy('name','asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddForm $request)
    {
        // return $request;
        $product = new Product;
        $product->name =  $request->name;
        $product->slug = Str::slug($request->name);
        $product->thumbnail = 'default.jpg';
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand = $request->brand;
        $product->main_upper_material = $request->main_upper_material;
        $product->outsole_material = $request->outsole_material;
        $product->gender = $request->gender;
        $product->summary = $request->summary;
        $product->description =  $request->description;
        $product->sku = 'sku';
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
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // return $product = Product::where('slug',$slug)->first();

        return view('backend.pages.products.show',[
           'product' => Product::where('slug',$slug)->first(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // return $slug;
        // return ;
        return view('backend.pages.products.edit',[
            'product' =>Product::where('slug',$slug)->first(),
            'categories' =>Category::orderBy('name','asc')->get(),
            'warranties' => productWarranty::latest()->get(),
            'returns' => ProductReturn::all(),
            'colors' =>ProductColor::orderBy('name','asc')->get(),
            'sizes' =>ProductSize::orderBy('name','asc')->get(),
        ]);
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

        $product->name =  $request->name;
        $product->slug = Str::slug($request->name);
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
        $product->save();
        // return 'updated';
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
        if($request->hasFile('image_galleries')){
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

        // die();
        $subcategory = Subcategory::where('category_id',$cat_id)->get();

        return response()->json($subcategory);

    }
}
