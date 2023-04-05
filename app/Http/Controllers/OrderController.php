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
use App\Models\EndUser;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->can('manage-orders')) { //admin
            $allOrders = Order::all(); //select * from posts
        } else if ($user->can('manage-own-orders')) { //user
            $allOrders = Order::where('user_id', $user->typeable->id)->get();
        } else if ($user->can('view-orders')) { //pharmacy
            $allOrders = Order::where('pharmacy_id', $user->typeable->id)->get();
        } else if ($user->can('update-order-status')) { //doctor
            $allOrders = Order::where('pharmacy_id', $user->typeable->pharmacy_id)->get();
        };
        return view('order.index', ['orders' => $allOrders]);
    }

    public  function show($id)
    {
        $order = Order::find($id);
        return view('order.show', ['order' => $order]);
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->can('manage-orders')) { //if admin

            $addresses = Address::all();
            $allUsers = EndUser::all();

            return view('order.create', ['addresses' => $addresses, 'all_users' => $allUsers]);
        } else if ($user->can('manage-own-orders')) { //if end user

            $addresses = Address::where('end_user_id', $user->typeable->id)->get();

            return view('order.create', ['addresses' => $addresses]);
        }
    }

    public  function store(StoreOrderRequest $request)
    {
        $valid_request = $request->validated();

        $user = Auth::user()->typeable;

        $order = new Order();
        $order->is_insured = request()->radio;
        $order->status = 'new';
        $order->delivery_address_id = request()->address;

        if ($user->can('manage-orders')) { //if admin
            $end_user = EndUser::find(request()->user);
            $order->user()->associate($end_user);
            $order->save();
        } else { //if end user
            $order->user()->associate($user);
            $order->save();
        }

        $Prescriptions = $request->file("Prescriptions");
        $paths = [];
        if ($Prescriptions) {
            foreach ($Prescriptions as $Prescription) {
                $paths[] = Storage::putFileAs(
                    'public/prescriptions',
                    $Prescription,
                    $Prescription->getClientOriginalName()
                );
            }
        }

        foreach ($paths as $path) {
            Prescription::create([
                'order_id' => $order->id,
                'prescription' => $path
            ]);
        }

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
        $user = Auth::user();

        // if (Gate::allows(['manage-own-orders', 'manage-orders', 'delete-orders'])) {
        //     abort(403, 'Unauthorized action.');
        // } else {
            $prescriptions = $order->prescriptions()->get(); //get all prescriptions of this order
            foreach ($prescriptions as $prescription) {
                if (Storage::exists($prescription->prescription)) { //delete from storage
                    Storage::delete($prescription->prescription);
                }
                $prescription->delete();
            }
            $orderMedicines = $order->orderMedicines()->get(); //get all records from order_include_medicine (actual order by pharmacy)
            if ($orderMedicines) { //if exists
                foreach ($orderMedicines as $orderMedicine) {
                    $orderMedicine->delete();
                }
            }
            $order->delete();

            return to_route('orders.index');
        // }
    }
}
