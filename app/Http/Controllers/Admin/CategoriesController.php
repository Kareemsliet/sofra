<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q=$request->q?$request->q:"";

        $categories=Category::select('*')->where('name','like',"%$q%")->orderByDesc('created_at')->paginate(10);

        $categories->withQueryString();

        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string|unique:categories,name",
        ]);

        Category::create($request->only('name'));

        return redirect()->route('categories.create')->with('message',"اضافة عنصر ينجاح");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::findOrFail($id);

        return view('admin.categories.show',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:categories,name,$id",
        ]);

        $category=Category::findOrFail($id);

        $category->update([
            'name'=>$request->name,
        ]);

        return redirect()->route('categories.edit',$id)->with('message',"تحديث عنصر ينجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $category=Category::findOrFail($id);

      $category->delete();

      return redirect()->route('categories.index')->with('message',"حذف عنصر ينجاح");

    }
}
