<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting=Setting::first();

        return view('admin.setting.index',compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string",
            'description'=>"required|string|max:250",
            'commission'=>"required|integer",
            'logo'=>"required|image|mimes:png,jpg,svg,jpeg|max:5550",
            'hero_image'=>$request->hero_image?"required|image|mimes:png,jpg,svg,jpeg|max:5550":"",
        ]);

        $logo=uniqid().'.'.$request->file('logo')->getClientOriginalExtension();

        $request->file('logo')->storeAs('setting/',$logo,['disk'=>"public"]);

        $request->merge(['commission'=>$request->commission/100]);

        $data=$request->only(['name','description','commission']);

        $data['logo']=$logo;

        if($request->hero_image){
            $image=uniqid().'.'.$request->file('hero_image')->getClientOriginalExtension();

            $request->file('hero_image')->storeAs('setting/',$image,['disk'=>"public"]);

            $data['hero_image']=$image;
        }

        Setting::create($data);

        return redirect()->route('setting.index')->with('message',"اضافة عنصر ينجاح");
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|max:70",
            'description'=>"required|string|max:250",
            'commission'=>"required|numeric|integer",
            'logo'=>$request->logo?"required|image|mimes:png,jpg,svg,jpeg|max:5550":"",
            'hero_image'=>$request->hero_image?"required|image|mimes:png,jpg,svg,jpeg|max:5550":"",
        ]);

        $setting=Setting::find($id);

        $request->merge(['commission'=>$request->commission/100]);

        $data=$request->only(['name','description','commission']);

        if($request->logo){

        Storage::delete(paths: "/setting/$setting->logo");

        $logo=uniqid().'.'.$request->file('logo')->getClientOriginalExtension();

        $request->file('logo')->storeAs('setting/',$logo,['disk'=>"public"]);

        $data['logo']=$logo;
       }

        if($request->hero_image){

            if($setting->hero_image){
                Storage::delete(paths: "/setting/$setting->hero_image");
            }

            $image=uniqid().'.'.$request->file('hero_image')->getClientOriginalExtension();

            $request->file('hero_image')->storeAs('setting/',$image,['disk'=>"public"]);

            $data['hero_image']=$image;
        }

        $setting->update($data);

        return redirect()->route('setting.index')->with('message',"تحديث الاعدادات ينجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $setting=Setting::findOrFail($id);

      if($setting->hero_image){
        Storage::delete(paths: "/setting/$setting->hero_image");
       }

       Storage::delete(paths: "/setting/$setting->logo");

      $setting->delete();

      return redirect()->route('setting.index')->with('message',"حذف الاعدادات ينجاح");
    }
}
