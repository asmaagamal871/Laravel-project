<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\Area;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacy = Pharmacy::all();
        //dd($pharmacies);
        return view('pharmacy.index', ['pharmacy' => $pharmacy]);
    }

    function create()
    {
        
        $pharmacy = Pharmacy::all();

        return view('pharmacy.create', ['pharmacy' => $pharmacy]);
            
        
    }

    public function store(Request $request)
    {
        $pharmacy = new Pharmacy();
        $pharmacy->id = $request->id;
        $pharmacy->name = $request->name;
        $pharmacy->email = $request->email;
        $pharmacy->password = Hash::make($request['password']);
        $pharmacy->priority = $request->priority;
        $pharmacy->area_id = $request->area_id;
        $pharmacy->save();
        return redirect()->route('pharmacy.index')->with(['Pharmacy created successfully']);

    }

    public function show($id)
    {
        $pharmacy = Pharmacy::find($id);

        return view('pharmacy.show', compact('pharmacy'));
    }

   public function edit($id)
    {
        $pharmacy = Pharmacy::find($id);
        return view('pharmacy.edit', ['pharmacy' => $pharmacy]);
    }

    public function update(Request $request , $id)
    {
        $pharmacy = Pharmacy::find($id);
        $pharmacy->name=$request->name;
        $pharmacy->email=$request->email;
        
        $pharmacy->save();
        return redirect()->route('pharmacy.index')->with(['Pharmacy updated successfully']);

    }

    public function destroy( $id)

    {
     pharmacy::where(['id'=>$id])->delete();
       
     return redirect()->route('pharmacy.index')->with(['success'=>'Pharmacy deleted successfully']);
    } 
}

