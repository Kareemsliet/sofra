<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q=$request->q?$request->q:"";

        $cities=City::select('*')->where('name','like',"%$q%")->paginate(10);

        $cities->withQueryString();

        return view('admin.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string|unique:cities,name",
        ]);

        City::create($request->only(['name']));

        return redirect()->route('cities.create')->with('message',"اضافة عنصر ينجاح");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city=City::findOrFail($id);

        return view('admin.cities.show',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:cities,name,$id",
        ]);

        $city=City::findOrFail($id);

        $city->update($request->only(['name']));

        return redirect()->route('cities.edit',$id)->with('message',"تحديث عنصر ينجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $city=City::findOrFail($id);

      $city->delete();

      return redirect()->route('cities.index')->with('message',"حذف عنصر ينجاح");

    }
}
