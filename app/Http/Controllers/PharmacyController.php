<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Http\Requests\BanDoctorRequest;
use App\Http\Requests\UnbanDoctorRequest;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Models\Ban;
use Cog\Laravel\Ban\Facades\Ban as BanFacade;

use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\Area;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->can('manage-pharmacies') || ($user->can('update-own-pharmacy'))) {
            //($user->can('manage-pharmacies')) {
            $pharmacy = Pharmacy::all();
            $pharmacy = Pharmacy::withTrashed()->get();
            return view('pharmacies.index', ['pharmacies' => $pharmacy]);
        }
        //$pharmacy = Pharmacy::whereNull('deleted_at')->get();
        //dd($pharmacies);
        else {
            abort(403, 'unauthorized action');
        }
    }

    public function revenue() 
    {
        $user = Auth::user();
        if ($user->hasRoles('admin')) {
            $pharmacies = Pharmacy::all();
            foreach ($pharmacies as $pharmacy) { //everytime the function is accessed it calculates the revenue and updates pharmacy info
                $orders = $pharmacy->orders()->get();
                $order_count = 0;
                $revenue = 0;
                foreach ($orders as $order) {
                    if ($order->status == 'delivered') {
                        $order_count++;
                        $revenue += $order->total_price;
                    }
                }
                $pharmacy->total_orders = $order_count;
                $pharmacy->revenue = $revenue;
                $pharmacy->save();
            }
            return view('pharmacies.revenue', ['pharmacies' => $pharmacies]);
        }
        if ($user->hasRoles('pharmacy')) {
            $pharmacy = Pharmacy::find($user->id);
            $orders = $pharmacy->orders()->get();
            $order_count = 0;
            $revenue = 0;
            foreach ($orders as $order) {
                if ($order->status == 'delivered') {
                    $order_count++;
                    $revenue += $order->total_price;
                }
            }
            $pharmacy->total_orders = $order_count;
            $pharmacy->revenue = $revenue;
            $pharmacy->save();
            return view('pharmacies.revenue', ['pharmacy' => $pharmacy]);
        }
    }

    function create()
    {
        $user = Auth::user();

        if ($user->can('manage-pharmacies')) {
            $areas = Area::all();
            $pharmacy = Pharmacy::all();

            return view('pharmacies.create', ['pharmacy' => $pharmacy], ['areas' => $areas]);
        } else {
            abort(403, 'unauthorized action');
        }
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        if ($user->can('manage-pharmacies')) {

            $newUser = Pharmacy::factory()->create(
                [

                    //'image' => $path,
                    'national_id' => $request->input('national_id'),
                    'area_id' => $request->input('area_id'),
                    'priority' => $request->input('priority')
                ]
            );

            $mainUser = User::factory()->create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'typeable_type' => 'pharmacy',
                    'typeable_id' => $newUser->id
                ]
            );

            $newUser->type()->save($mainUser);
            $newUser->assignRole('pharmacy');
            $newUser->givePermissionTo(['manage-own-doctors', 'update-own-pharmacy']);
            return redirect()->route('pharmacies.index');
        }


        /*$pharmacy = new Pharmacy();
        $pharmacy->id = $request->id;
        $pharmacy->name = $request->name;
        $pharmacy->email = $request->email;
        $pharmacy->password = Hash::make($request['password']);
        $pharmacy->priority = $request->priority;
        $pharmacy->area_id = $request->area_id;
        $pharmacy->national_id = $request->national_id;
        $pharmacy->save();
        return redirect()->route('pharmacy.index')->with(['Pharmacy created successfully']);*/ else {
            abort(403, 'unauthorized action');
        }
    }

    public function show($id)
    {
        $user = Auth::user();
        $pharmacy = Pharmacy::withTrashed()->findOrFail($id);
        if ($user->can('manage-pharmacies')) {

            $doctors = $pharmacy->doctors;

            foreach ($doctors as $doctor) {
                $doctor->is_banned = $pharmacy->isBanned($doctor);
            }

            //$doctors = $pharmacy->doctors;

            return view('pharmacies.show', compact('pharmacy', 'doctors'));
        } else {
            abort(403, 'unauthorized action');
        }

        //$pharmacy = Pharmacy::find($id);
    }

    public function edit($id)
    {
        $pharmacy = Pharmacy::withTrashed()->find($id);

        $user = Auth::user();

        if ($user->can('manage-pharmacies') || ($user->can('update-own-pharmacy') && $user->typeable->id == $pharmacy->id)) {


            // Return the edit view with the pharmacy and areas
            return view('pharmacies.edit', ['pharmacy' => $pharmacy]);
        } else {
            // User does not have permission to edit pharmacy
            abort(403, 'unauthorized action');
        }
    }

    public function update(Request $request, $id)
    {

        $pharmacy = Pharmacy::find($id);
        $user = Auth::user();
        if ($user->can('manage-pharmacies') || ($user->can('update-own-pharmacy') && $user->typeable->id == $pharmacy->id)) {

            if ($user->can('manage-pharmacies')) {
                $pharmacy->type->name = $request['name'];
                $pharmacy->type->email = $request['email'];
                $pharmacy->priority = $request['priority'];
                $pharmacy->area_id = $request['area_id'];
                $pharmacy->national_id = $request['national_id'];
                //$pharmacy->image = $request['image'];

            }

            if ($user->can('update-own-pharmacy')) {
                $pharmacy->type()->name = $request['name'];
                $pharmacy->type()->email = $request['email'];
                $pharmacy->national_id = $request['national_id'];
            }

            // Save changes
            $pharmacy->save();
            $pharmacy->type->save();
            //return view('pharmacies.edit', ['pharmacy' => $pharmacy]);

            return redirect()->route('pharmacies.index')->with(['Pharmacy updated successfully']);
        } else {
            // User does not have permission to update pharmacy
            abort(403, 'unauthorized action');
        }
    }

    public function destroy($id)

    {
        $user = Auth::user();
        $pharmacy = Pharmacy::withTrashed()->findOrFail($id);

        if ($user->can('manage-pharmacies')) {

            if ($pharmacy->trashed()) {
                $pharmacy->restore();
                return redirect()->route('pharmacies.index')->with('success', 'Pharmacy restored successfully!');
            }

            $pharmacy->delete();

            return redirect()->route('pharmacies.index')->with('success', 'Pharmacy deleted successfully!');
        } else {
            abort(403, 'unauthorized action');
        }
    }


    //pharmacy::where(['id'=>$id])->delete();

    public function restore($id)
    {

        //$pharmacy = Pharmacy::onlyTrashed()->where('id', $request->pharmacy);
        $user = Auth::user();
        $pharmacy = Pharmacy::withTrashed()->findOrFail($id);

        if ($user->can('manage-pharmacies')) {

            $pharmacy->restore();

            return redirect()->route('pharmacies.index')->with(['success' => 'Pharmacy Restored successfully']);
        } else {
            abort(403, 'unauthorized action');
        }
    }

    public function ban(Pharmacy $pharmacy, Doctor $doctor)
    {
        $user = Auth::user();

        if ($user->can('manage-pharmacies') || ($user->can('manage-own-doctors'))) {


            $doctor->ban();

            return redirect()->back()->with('success', 'Doctor banned successfully.');
        } else {
            // User does not have permission to edit pharmacy
            abort(403, 'unauthorized action');
        }
    }

    public function unban(Pharmacy $pharmacy, Doctor $doctor)
    {
        $user = Auth::user();

        if ($user->can('manage-pharmacies') || ($user->can('manage-own-doctors'))) {

            $doctor->unban();


            return redirect()->back()->with('success', 'Doctor unbanned successfully.');
        } else {
            // User does not have permission to unban doctor
            abort(403, 'unauthorized action');
        }
    }
}
