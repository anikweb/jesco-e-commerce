<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicSettingsUpdateForm;
use App\Models\BasicSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class BasicSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.site_setting.index',[
            'site_info' => BasicSetting::first(),
        ]);
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
     * @param  \App\Models\BasicSetting  $basicSetting
     * @return \Illuminate\Http\Response
     */
    public function show(BasicSetting $basicSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BasicSetting  $basicSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(BasicSetting $basicSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BasicSetting  $basicSetting
     * @return \Illuminate\Http\Response
     */
    public function update(BasicSettingsUpdateForm $request, BasicSetting $basicSetting)
    {


        $basicSetting->site_title =$request->site_title;
        $basicSetting->tagline =$request->tagline;
        $basicSetting->key_words =$request->key_words;
        if($request->new_registration){
            $basicSetting->new_registration = $request->new_registration;
        }else{
            $basicSetting->new_registration = 1;
        }
        if($request->new_login){
            $basicSetting->new_login = $request->new_login;
        }else{
            $basicSetting->new_login = 1;
        }
        $basicSetting->save();

        if($request->hasFile('logo')){
            $old_logo = public_path('assets/images/logo').'/'.$basicSetting->logo;
            if(file_exists($old_logo)){
                unlink($old_logo);
            }
            $logo = $request->file('logo');
            $newLogoName = Str::slug($basicSetting->site_title).'-'.date('Y_m_d').'-logo'.'.'.$logo->getClientOriginalExtension();
            $path = public_path('assets/images/logo').'/';
            Image::make($logo)->save($path.$newLogoName);
            $basicSetting->logo = $newLogoName;
            $basicSetting->save();
        }
        if($request->hasFile('icon')){
            $old_icon = public_path('assets/images/favicon').'/'.$basicSetting->icon;
            if(file_exists($old_icon)){
                unlink($old_icon);
            }
            $icon = $request->file('icon');
            $newiconName = Str::slug($basicSetting->site_title).'-'.date('Y_m_d').'-icon'.'.'.$icon->getClientOriginalExtension();
            $path2 = public_path('assets/images/favicon').'/';
            Image::make($icon)->save($path2.$newiconName);
            $basicSetting->icon = $newiconName;
            $basicSetting->save();
        }
        return back()->with('success','Saved Changes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BasicSetting  $basicSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(BasicSetting $basicSetting)
    {
        //
    }
}
