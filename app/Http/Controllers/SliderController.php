<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddForm;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->can('slider view')){
            return view('backend.pages.slider.index',[
                'sliders' => Slider::latest()->paginate('10'),
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
        if(auth()->user()->can('slider add')){
            return view('backend.pages.slider.create');
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
    public function store(SliderAddForm $request)
    {
        if(auth()->user()->can('slider add')){
            $slider = new Slider;
            $slider->title = $request->title;
            $slider->promotions = $request->promotions;
            $slider->url = $request->url;
            $slider->save();
            if($request->hasFile('image')){
                $image = $request->file('image');
                $newImageName = Str::slug($slider->title).'-'.date('Y_m_d_h_i_s').time().'.'.$image->getClientOriginalExtension();
                // Create Dynamic Folder Start
                $path = public_path('assets/images/slider-image/');
                // Create Dynamic Folder End
                Image::make($image)->save($path.$newImageName);
                $slider->image = $newImageName;
                $slider->save();
                return redirect()->route('slider.index')->with('success','New Slider Created!');
            }
        }else{
            return abort(404);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        if(auth()->user()->can('slider edit')){
            return view('backend.pages.slider.edit',compact('slider'));
        }else{
            return abort(404);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        if(auth()->user()->can('slider edit')){
            $slider->title = $request->title;
            $slider->promotions = $request->promotions;
            $slider->url = $request->url;
            $slider->save();
            if($request->hasFile('image')){
                $oldImage = public_path('assets/images/slider-image/'.$slider->image);
                if(file_exists($oldImage)){
                    unlink($oldImage);
                }
                $image = $request->file('image');
                $newImageName = Str::slug($slider->title).'-'.date('Y_m_d_h_i_s').time().'.'.$image->getClientOriginalExtension();
                // Create Dynamic Folder Start
                $path = public_path('assets/images/slider-image/');
                // Create Dynamic Folder End
                Image::make($image)->save($path.$newImageName);
                $slider->image = $newImageName;
                $slider->save();
            }
            return redirect()->route('slider.index')->with('success','Slider Updated!');
        }else{
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if(auth()->user()->can('slider trash')){

            $slider->delete();
            return back()->with('success','Slider deleted!');
        }else{
            return abort(404);
        }
    }
    public function sliderDeactivate($slider_id)
    {
        if(auth()->user()->can('slider deactivate')){
            $slider = Slider::find($slider_id);
            $slider->status = 2;
            $slider->save();
            return back()->with('success','Slider Deactivated!');
        }else{
            return abort(404);
        }
    }
    public function sliderActive($slider_id)
    {
        if(auth()->user()->can('slider activate')){
            $slider = Slider::find($slider_id);
            $slider->status = 1;
            $slider->save();
            return back()->with('success','Slider Activated!');
        }else{
            return abort(404);
        }
    }

}
