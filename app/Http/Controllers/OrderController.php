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
use App\Jobs\AssignOrderJob;
use App\Jobs\OrderConfirmationJob;
use App\Mail\OrderConfirmationMail;
use App\Models\EndUser;
use App\Models\Medicine;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Foreach_;

class OrderController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('order.index');
    }

    public function show($id)
    {
        $order = Order::find(1);
        $user = User::find(5);
        // dispatch(new OrderConfirmationJob($user, $order));

        return view('order.show', ['order' => $order]);
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) { //if admin
            $addresses = Address::all();
            $allUsers = EndUser::all();
            return view('order.create', ['addresses' => $addresses, 'all_users' => $allUsers]);
        } elseif ($user->hasRole('end-user')) { //if end user
            $addresses = Address::where('end_user_id', $user->typeable->id)->get();
            return view('order.create', ['addresses' => $addresses]);
        } elseif ($user->hasRole('pharmacy')) {
            $medicines = Medicine::all();
            $new_orders = Order::where('pharmacy_id', $user->typeable->id)->where('status', 'processing')->get();
            if ($new_orders->first()) {
                return view('order.create', ['new_orders' => $new_orders, 'medicines' => $medicines]);
            } else {
                return redirect()->route('orders.index')->with(
                    'error',
                    'No new orders available.'
                );
            }
        }
    }

    public function store()
    {
        $user = Auth::user();

        $order = new Order();
        $order->is_insured = request()->radio;
        $order->status = 'new';
        $order->address_id = request()->address;

        if ($user->can('manage-own-orders')) { //admin or user
            // $valid_request = $request->validated();
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
            AssignOrderJob::dispatch();
            return to_route('orders.index');
        } elseif ($user->hasRole('pharmacy')) {
            $total_price = 0.0;
            $medicines = request()->input('meds'); //array of medicine id's
            // dd($medicines);
            $quantity = request()->input('quantity');
            $order = Order::find(request()->order);
            $i = 0;
            if (in_array(null, $quantity, true)) {
                return redirect()->route('orders.edit', ['order' => $order])->with(
                    'error',
                    'Missing quantities for new medicines selected.'
                );
            } else {
                foreach ($medicines as $medicine) {
                    $medicine_in_table = Medicine::find($medicine);
                    if ($medicine_in_table) {
                        OrderMedicine::create([
                            'order_id' => request()->order,
                            'medicine_id' => $medicine,
                            'qty' => $quantity[$i]
                        ]);
                    }
                    $i = $i + 1;
                }
            }

            $orderMedicines = $order->orderMedicines()->get(); //collection
            // dd($order->address) ;
            foreach ($orderMedicines as $record) {
                
                $total_price = $total_price + ($record->qty * $record->medicine()->first()->price);
            }
            $order->total_price = $total_price;
            $order->status = 'waitingCustConfirmation';

            $order->save();

            if ($order->status == "waitingCustConfirmation") {
                $enduser2 = User::where('id', '=', $order->user->type->id)->first();

                dispatch(new OrderConfirmationJob($enduser2, $order));
            }

            return to_route('orders.index');
        } else {
            abort(403, 'Unauthorized request.');
        }
    }

    public function edit($id)
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) { //if admin
            $allUsers = EndUser::all();
            $order = Order::find($id);
            $medicines = Medicine::all();
            $addresses = $order->user()->first()->addresses()->get();
            return view('order.edit', ['addresses' => $addresses, 'all_users' => $allUsers, 'order' => $order, 'medicines' => $medicines]);
        } elseif ($user->hasRole('end-user')) { //if end user
            $order = Order::find($id);
            $addresses = Address::where('end_user_id', $user->typeable->id)->get();
            if ($order->status == 'new') {
                return view('order.edit', ['addresses' => $addresses, 'order' => $order]);
            } else {
                return redirect()->route('orders.index')->with(
                    'error',
                    'Sorry, order is already assigned to a pharmacy.'
                );
            }
        } elseif ($user->hasRole('doctor')) { //if doctor
            $order = Order::find($id);
            if ($order->status == 'processing') {
                return redirect()->route('orders.index')->with(
                    'error',
                    'The order has not been fulfilled yet.'
                );
            } elseif ($order->status == 'delivered') {
                return redirect()->route('orders.index')->with(
                    'error',
                    'The order has been delivered.'
                );
            } else {
                return view('order.edit', ['order' => $order]);
            }
        } elseif ($user->hasRole('pharmacy')) { //if pharmacy
            $order = Order::find($id);
            if ($order->status != 'waitingCustConfirmation') {
                return redirect()->route('orders.index')->with(
                    'error',
                    'This order is already ' . $order->status . '.'
                );
            } else {
                $medicines = Medicine::all();
                return view('order.edit', ['medicines' => $medicines, 'order' => $order]);
            }
        }
    }

    public function update($id)
    {
        $user = Auth::user();
        $order = Order::find($id);
        if ($user->hasAnyRole(['admin', 'end-user'])) { //if end user
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
            if ($user->hasRole('end-user')) {
                return to_route('orders.index');
            }
        }
        if ($user->hasAnyRole(['admin', 'pharmacy'])) { //if pharmacy
            $medicines = request()->input('meds'); //array of medicine id's
            $quantity = request()->input('quantity');
            $order = Order::find(request()->order); //get order to be modified
            $total_price = 0.0; //reset total price
            $i = 0;
            if ($medicines) { //if user updated medicines
                if (in_array(null, $quantity, true)) {
                    return redirect()->route('orders.edit', ['order' => $order])->with(
                        'error',
                        'Missing quantities for new medicines selected.'
                    );
                } else {
                    $old_orderMedicines = $order->orderMedicines()->get(); //get previous records of medicines
                    foreach ($old_orderMedicines as $old_orderMedicine) { //delete old records
                        $old_orderMedicine->delete();
                    }
                    foreach ($medicines as $medicine) { //create new records
                        $medicine_in_table = Medicine::find($medicine); //if this is a saved medicine
                        if ($medicine_in_table) { //create order record
                            OrderMedicine::create([
                                'order_id' => $id,
                                'medicine_id' => $medicine,
                                'qty' => $quantity[$i]
                            ]);
                        }
                        $i = $i + 1;
                    }
                }

                $orderMedicines = $order->orderMedicines()->get();
                foreach ($orderMedicines as $record) { //update total price
                    $total_price = $total_price + ($record->qty * $record->medicine()->first()->price);
                }
                $order->total_price = $total_price;
                $order->status = 'waitingCustConfirmation';
                $order->save();
            }
            if ($user->hasRole('pharmacy')) {
                return to_route('orders.index');
            }
        }
        if ($user->hasRole('doctor')) { //if doctor
            $order = Order::find($id);
            if (request()->status) {
                $order->status = request()->status;
                $order->save();
            }
            return to_route('orders.index');
        }
        if ($user->hasRole('admin')) {
            return to_route('orders.index');
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
    // public function confirm($id){
    //     $order = Order::find($id);
    //     $order->status='confirmed';
    //     $order->save();
    // }
    public function cancel($id){
        $order = Order::find($id);
        $order->status='cancelled';
        $order->save();
        return view('cancel');
    }
}
