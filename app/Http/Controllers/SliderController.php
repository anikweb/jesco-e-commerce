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
        return view('backend.pages.slider.index',[
            'sliders' => Slider::latest()->paginate('10'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderAddForm $request)
    {
        // return $request;
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
        // return $slider;
        return view('backend.pages.slider.edit',compact('slider'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $oldImage = public_path('assets/images/slider-image/'.$slider->image);
        if(file_exists($oldImage)){
            unlink($oldImage);
        }
        $slider->delete();
        return back()->with('success','Slider deleted!');
    }
    public function sliderDeactivate($slider_id)
    {
        $slider = Slider::find($slider_id);
        $slider->status = 2;
        $slider->save();
        return back()->with('success','Slider Deactivated!');
    }
    public function sliderActive($slider_id)
    {
        $slider = Slider::find($slider_id);
        $slider->status = 1;
        $slider->save();
        return back()->with('success','Slider Activated!');
    }

}
