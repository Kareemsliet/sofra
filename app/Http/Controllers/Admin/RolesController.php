<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q=$request->q?$request->q:"";

        $roles=Role::select('*')->where('name','like',"%$q%")->paginate(10);

        $roles->withQueryString();

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::all();

        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>"required|string|unique:roles,name",
            'permissions'=>"required|array|min:1",
            'permissions.*'=>"required|exists:permissions,id",
        ]);

        $role=Role::create($request->only(['name']));

        $permissions=Permission::findMany($request->permissions);

        $role->syncPermissions($permissions);

        return redirect()->route('roles.create')->with('message',"اضافة عنصر ينجاح");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=Role::findOrFail($id);

        $permissions=Permission::all();

        return view('admin.roles.show',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:roles,name,$id",
            'permissions'=>"required|array|min:1",
            'permissions.*'=>"required|exists:permissions,id",
        ]);

        $role=Role::findOrFail($id);

        $role->update($request->only(['name']));

        $permissions=Permission::findMany($request->permissions);

        $role->syncPermissions($permissions);

        return redirect()->route('roles.edit',$id)->with('message',"تحديث عنصر ينجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $role=Role::findOrFail($id);

      $role->syncPermissions();

      $role->delete();

      return redirect()->route('roles.index')->with('message',"حذف عنصر ينجاح");

    }
}
