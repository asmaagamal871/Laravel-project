<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Models\Order;
use App\Models\User;
use App\Models\Address;
use App\Models\Prescription;
use App\Models\OrderMedicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreOrderRequest;
use App\Jobs\OrderConfirmationJob;
use App\Mail\OrderConfirmationMail;
use App\Models\EndUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('order.index');
    }

    public function show($id)
    {
        // $order = Order::find(1);
        // $user = User::find(5);
        // dispatch(new OrderConfirmationJob($user, $order));

        return view('order.show', ['order' => $order]);
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->can('manage-orders')) { //if admin
            $addresses = Address::all();
            $allUsers = EndUser::all();

            return view('order.create', ['addresses' => $addresses, 'all_users' => $allUsers]);
        } elseif ($user->can('manage-own-orders')) { //if end user
            $addresses = Address::where('end_user_id', $user->typeable->id)->get();

            return view('order.create', ['addresses' => $addresses]);
        }
    }

    public function store(StoreOrderRequest $request)
    {
        $valid_request = $request->validated();

        $user = Auth::user();

        $order = new Order();
        $order->is_insured = request()->radio;
        $order->status = 'new';
        $order->address_id = request()->address;

        if ($user->can('manage-own-orders')) { //admin or user
            if ($user->can('manage-orders')) { //if admin
                $end_user = EndUser::find(request()->user);
                $address = Address::find(request()->address);
                if ($address->end_user()->first() == $end_user) {
                    $order->creator_type = 'admin';
                    $order->user()->associate($end_user);
                    $order->save();
                } else {
                    return redirect()->route('orders.create')->with(
                        'error',
                        'The address chosen is not associated with the user chosen.'
                    );
                }
            } else { //if end user
                $order->creator_type = 'user';
                $user = $user->typeable;
                $order->user()->associate($user);
                $order->save();
            }

            $Prescriptions = $request->file("Prescriptions");
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

            return to_route('orders.index');
        } else {
            abort(403, 'Unauthorized request.');
        }
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->can('manage-orders')) { //if admin
            $addresses = Address::all();
            $allUsers = EndUser::all();
            return view('order.edit', ['addresses' => $addresses, 'all_users' => $allUsers]);
        } elseif ($user->can('manage-own-orders')) { //if end user
            $order = Order::find($id);
            $addresses = Address::where('end_user_id', $user->typeable->id)->get();
            return view('order.edit', ['addresses' => $addresses, 'order' => $order]);
        } elseif ($user->can('update-order-status')) { //if doctor
            $doctor = $user->typeable;
            $pharmacy = $doctor->pharmacy()->first();
            $orders = $pharmacy->orders()->get();
            return view('order.edit', ['orders' => $orders]);
        } elseif ($user->can('edit-orders')) { //if pharmacy
            $pharmacy = $user->typeable;
        }
    }

    public function update($id)
    {
        $user = Auth::user();
        $order = Order::find($id);
        if ($user->cannot('manage-orders')) { // if not admin
            if ($user->can('manage-own-orders')) { //if end user
                if ($order->status == 'new') { //users are only allowed to edit new orders
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
                } else {
                    return redirect()->route('orders.index')->with(
                        'error',
                        'Sorry, order is already assigned to a pharmacy.'
                    );
                }
                return to_route('orders.index');
            }
        }
        if ($user->hasRole('doctor')) {
        }
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $user = Auth::user();

        if ($user->can('delete-orders')) {
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
        } else {
            abort(403, 'Unauthorized request.');
        }
    }
}
