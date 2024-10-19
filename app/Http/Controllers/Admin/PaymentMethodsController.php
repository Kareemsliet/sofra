<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
   /**
     * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        $q=$request->q?$request->q:"";

        $payment_methods=PaymentMethod::select('*')->where('name','like',"%$q%")->paginate(10);

        $payment_methods->withQueryString();

        return view('admin.payment-methods.index',compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required|string|unique:payments_methods,name",
            'description'=>"required|string|max:250",
        ]);

        PaymentMethod::create(['name'=>$request->name,'description'=>$request->description]);

        return redirect()->route('payment-methods.create')->with('message',"اضافة عنصر ينجاح");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment_method=PaymentMethod::findOrFail($id);

        return view('admin.payment-methods.show',compact('payment_method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>"required|string|unique:payments_methods,name,$id",
            'description'=>"required|string|max:250",
        ]);

        $payment_method=PaymentMethod::findOrFail($id);

        $payment_method->update([
            'name'=>$request->name,
            'description'=>$request->description
        ]);

        return redirect()->route('payment-methods.edit',$id)->with('message',"تحديث عنصر ينجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $payment_method=PaymentMethod::findOrFail($id);

      $payment_method->delete();

      return redirect()->route('payment-methods.index')->with('message',"حذف عنصر ينجاح");

    }
}
