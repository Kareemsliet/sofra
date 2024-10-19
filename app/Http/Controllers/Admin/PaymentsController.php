<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search=$request->q?$request->q:"";

        $payments=Payment::select('*')->whereHas('restaurant',function($query)use($search){
            $query->where('restaurants.name','like',"%$search%");
        })->orderByDesc('created_at')->paginate(10);

        return view('admin.payments.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants=Restaurant::all();

        return view('admin.payments.create',compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'total'=>"required|numeric",
            'restaurant_id'=>"required|exists:restaurants,id",
        ]);

        Payment::create($request->only(keys: ['total','restaurant_id']));

        return redirect()->route('payments.create')->with('message',"اضافة عنصر ينجاح");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment=Payment::findOrFail($id);

        $restaurants=Restaurant::all();

        return view('admin.payments.show',compact('payment','restaurants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'total'=>"required|numeric",
            'restaurant_id'=>"required|exists:restaurants,id",
        ]);

        $payment=Payment::findOrFail($id);

        $payment->update($request->only(keys: ['total','restaurant_id']));

        return redirect()->route('payments.edit',$id)->with('message',"تحديث عنصر ينجاح");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      $payment=Payment::findOrFail($id);

      $payment->delete();

      return redirect()->route('payments.index')->with('message',"حذف عنصر ينجاح");

    }
}
