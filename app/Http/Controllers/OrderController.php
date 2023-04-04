<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\Prescription;
use App\Models\OrderMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    // use HasRoles;
    public function index()
    {
        $user = Auth::user();
        
        if ($user->can('manage-orders')) {
            $allOrders = Order::all(); //select * from posts
        } if($user->can('manage-own-orders')) {
            $allOrders = Order::where('user_id', $user->typeable->id)->get();
        }if($user->can('view-orders')){
            $allOrders = Order::where('pharmacy_id', $user->typeable->id)->get();
        }
        return view('order.index', ['orders' => $allOrders]);
    }
    public function create()
    {
        $id = Auth::id();
        $addresses = Address::where('user_id', $id);
        return view('order.create', ['addresses' => $addresses]);
    }
    public  function show($id)
    {
        $order = Order::find($id);
        return view('order.show', ['order' => $order]);
    }

    public  function store(StoreOrderRequest $request)
    {
        $valid_request = $request->validated();

        $id = Auth::id();
        $user = User::find($id);

        $order = new Order();
        $order->is_insured = request()->is_insured;
        $order->status = 'new';
        $order->delivery_address_id = request()->address;
        $user->Orders()->save($order);

        $Prescriptions = $request->file("Prescriptions");
        $paths = [];
        if ($Prescriptions) {
            foreach ($Prescriptions as $Prescription) {
                $paths[] = Storage::put('public/Prescriptions' . $Prescription->getClientOriginalName(), $Prescription);
            }
        }

        foreach ($paths as $path) {
            Prescription::create([
                'order_id' => $order->id,
                'prescription' => $path
            ]);
        }

        // Order::create([
        //     'is_insured' => $is_insured,
        //     'status' => 'new',
        //     'delivery_address_id' => 'address'
        // ]);
        return to_route('orders.index');
    }

    public  function edit()
    {
    }

    public  function update()
    {
    }

    public  function destroy($id)
    {
        $order = Order::find($id);
        $prescriptions = Prescription::where('order_id', $id);
        if ($prescriptions) {
            foreach ($prescriptions as $prescription) {
                $prescription->delete();
            }
        }
        $medicines = OrderMedicine::where('order_id', $id);
        if ($medicines) {
            foreach ($medicines as $medicine) {
                $medicine->delete();
            }
        }
        $order->delete();
        return to_route('orders.index');
    }
}
