<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
     /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {

        $q=$request->q?$request->q:"";

        $users=User::select('*')->whereAny(['email','name'],'like',"%$q%")->orderByDesc('created_at')->paginate(10);

        $users->withQueryString();

        return view('admin.users.index',compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();

        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string|unique:users,name",
            'email'=>"required|email|string|unique:users,email",
            'password'=>"required|string|min:8|confirmed",
            'roles'=>"required|array|min:1",
            'roles.*'=>"required|exists:roles,id",
        ]);

        $request->merge(['password'=>Hash::make($request->password)]);

        $user=User::create($request->only(['name','email','password']));

        $roles=Role::findMany($request->roles);

        $user->syncRoles($roles);

        return redirect()->route('users.create')->with("message","تم اضافة مستخدم بنجاح");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::findOrFail($id);

        $roles=Role::all();

        return view('admin.users.show',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:users,name,$id",
            'email'=>"required|email|string|unique:users,email,$id",
            'password'=>$request->password?"required|string|min:8|confirmed":"",
            'roles'=>"required|array|min:1",
            'roles.*'=>"required|exists:roles,id",
        ]);

        $user=User::findOrFail($id);

        $data=$request->only(['name','email']);

        if($request->password){

            $password=Hash::make($request->password);

            $data['password']=$password;

        }

        $user->update($data);

        $roles=Role::findMany($request->roles);

        $user->syncRoles($roles);

        return redirect()->route('users.edit',$id)->with('message',"تحديث عنصر ينجاح");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $user=User::findOrFail($id);

      $user->syncRoles();

      $user->delete();

      return redirect()->route('users.index')->with('message',"حذف عنصر ينجاح");
    }
}
