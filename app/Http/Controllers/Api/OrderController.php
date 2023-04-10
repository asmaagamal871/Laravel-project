<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allOrders = Order::where('user_id', $user->typeable->id)->get();
        
        // return view('order.index', ['orders' => $allOrders]);  
    }

    public  function show($id)
    {
        $order = Order::find($id);
        // return view('order.show', ['order' => $order]);
    }

    public  function store()
    {
        $user = Auth::user();
        $order = new Order();
        $order->is_insured = request()->radio;
        $order->status = 'new';
        $order->address_id = request()->address;

        $order->creator_type = 'user';
        $user = $user->typeable;
        $order->user()->associate($user);
        $order->save();

        $Prescriptions = request()->file("Prescriptions");
        foreach ($Prescriptions as $Prescription) {
            $paths[] = Storage::putFileAs(
                'public/prescriptions',
                $Prescription,
                $Prescription->getClientOriginalName()
            );
        }
        foreach ($paths as $path) {
            Prescription::create([
                'order_id' => $order->id,
                'prescription' => $path
            ]);
        }

        return response()->json([
            'message' => 'order created successfully'
        ]);
    }

    public  function update($id)
    {
        $user = Auth::user();
        $order = Order::find($id);
        $order->update([
            'is_insured' => request()->radio,
            'address_id' => request()->address
        ]);

        $prescriptions = request()->file("Prescriptions");
        if ($prescriptions) {
            $old_prescriptions = $order->prescriptions()->get(); //get all prescriptions of this order
            foreach ($old_prescriptions as $prescription) {
                if (Storage::exists($prescription->prescription)) {
                    Storage::delete($prescription->prescription); //delete from storage
                    //delete record
                }
                $prescription->delete(); //delete all old prescriptions to add new ones
            }
            foreach ($prescriptions as $Prescription) { //save new ones in storage
                $paths[] = Storage::putFileAs(
                    'public/prescriptions',
                    $Prescription,
                    $Prescription->getClientOriginalName()
                );
            }
            foreach ($paths as $path) {  //create new instances
                Prescription::create([
                    'order_id' => $id,
                    'prescription' => $path
                ]);
            }
        }
        return response()->json([
            'message' => 'order updated successfully'
        ]);
    }
}
