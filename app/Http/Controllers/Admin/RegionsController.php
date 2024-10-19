<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q=$request->q?$request->q:"";

        $regions=Region::select('*')->whereHas('city',function($query)use($q){
            $query->where('regions.name','like',"%$q%")->orWhere('cities.name','like',"%$q%");
        })->orderByDesc('created_at')->paginate(10);

        $regions->withQueryString();

        return view('admin.regions.index',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities=City::all();
        return view('admin.regions.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string|unique:regions,name",
            'city_id'=>"required|exists:cities,id"
        ]);

        Region::create(['name'=>$request->name,
         'city_id'=>$request->city_id,]);
        return redirect()->route('regions.create')->with('message',"اضافة عنصر ينجاح");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $region=Region::findOrFail($id);

        $cities=City::all();

        return view('admin.regions.show',compact('region','cities'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:regions,name,$id",
            'city_id'=>"required|exists:cities,id"
        ]);

        $region=Region::findOrFail($id);

        $region->update([
            'name'=>$request->name,
            'city_id'=>$request->city_id,
        ]);

        return redirect()->route('regions.edit',$id)->with('message',"تحديث عنصر ينجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $region=Region::findOrFail($id);

      $region->delete();

      return redirect()->route('regions.index')->with('message',"حذف عنصر ينجاح");
    }
    
}
