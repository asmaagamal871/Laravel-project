<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Http\Requests\BanDoctorRequest;
use App\Http\Requests\UnbanDoctorRequest;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Models\Ban;
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
        
        if ($user->can('manage-pharmacies'))
        {
        $pharmacy = Pharmacy::all();
        $pharmacy = Pharmacy::withTrashed()->get();
        return view('pharmacy.index', ['pharmacy' => $pharmacy]);
        }
        //$pharmacy = Pharmacy::whereNull('deleted_at')->get();
        //dd($pharmacies);
       else
        { 
        abort(403,'unauthorized action');
        }
    }

    function create()
    {
        $user = Auth::user();

        if ($user->can('manage-pharmacies')) {
            
            $pharmacy = Pharmacy::all();

            return view('pharmacy.create', ['pharmacy' => $pharmacy]);
        } 
        
        else {
            abort(403,'unauthorized action');
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
        $newUser->givePermissionTo(['manage-own-doctors','update-own-pharmacy']);
        return redirect()->route('pharmacy.index');
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
        return redirect()->route('pharmacy.index')->with(['Pharmacy created successfully']);*/
         
        else 
        {
            abort(403,'unauthorized action');
        }
        

    }

    public function show($id)
    {
        $user = Auth::user();
        $pharmacy = Pharmacy::withTrashed()->findOrFail($id);
        if ($user->can('manage-pharmacies') || $user->typeable->id == $pharmacy->id) 
        
        {
            $doctors = $pharmacy->doctors;

        foreach ($doctors as $doctor) {
            $doctor->is_banned = $pharmacy->isBanned($doctor);
        }

        //$doctors = $pharmacy->doctors;

        return view('pharmacy.show', compact('pharmacy', 'doctors'));
        } 
        
        else {
            abort(403,'unauthorized action');
        }
        
        //$pharmacy = Pharmacy::find($id);
        }

   public function edit($id)
    {
        $pharmacy = Pharmacy::withTrashed()->find($id);
       
        $user = Auth::user();
    
        if ($user->can('manage-pharmacies') || ($user->can('update-own-pharmacy') && $user->typeable->id == $pharmacy->id)) {
        
    
            // Return the edit view with the pharmacy and areas
            return view('pharmacy.edit', ['pharmacy' => $pharmacy]);
    
        } else {
            // User does not have permission to edit pharmacy
            abort(403,'unauthorized action');
        }

        /*if (auth()->user()->isAdmin()) {
        return view('pharmacy.edit', ['pharmacy' => $pharmacy]);
    }

    // check if the authenticated user is the pharmacy owner
    if (auth()->user()->id === $pharmacy->id) {
        return view('pharmacy.edit', ['pharmacy' => $pharmacy])->except(['priority', 'area_id']);
    }

    abort(403); */
    }

    public function update(Request $request , $id)
    {
        $pharmacy = Pharmacy::find($id);

        $user = Auth::user();
    if ($user->can('manage-pharmacies') || ($user->can('update-own-pharmacy') && $user->typeable->id == $pharmacy->id)) {
        
        // Validate request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$pharmacy->user->id,
            'area_id' => ($user->can('manage-pharmacies') ? 'required' : ''),
            'priority' => ($user->can('manage-pharmacies') ? 'required|integer|min:0' : '')
        ]);

        // Update pharmacy attributes
        $pharmacy->name = $validatedData['name'];
        $pharmacy->email = $validatedData['email'];

        // Only update area_id and priority if user is admin
        if ($user->can('manage-pharmacies')) {
            $pharmacy->name = $validatedData['name'];
            $pharmacy->email = $validatedData['email'];
            $pharmacy->area_id = $validatedData['area_id'];
            $pharmacy->priority = $validatedData['priority'];
        }

        // Save changes
        $pharmacy->save();

        return redirect()->route('pharmacy.index')->with(['Pharmacy updated successfully']);

    } else {
        // User does not have permission to update pharmacy
        abort(403,'unauthorized action');
    }
        
        // check if the authenticated user is an admin
    /*if (auth()->user()->isAdmin()) {
        $pharmacy->name = $request->name;
        $pharmacy->email = $request->email;
        $pharmacy->priority = $request->priority;
        $pharmacy->area_id = $request->area_id;
    } else {
        // check if the authenticated user is the pharmacy owner
        if (auth()->user()->id === $pharmacy->id) {
            $pharmacy->name = $request->name;
            $pharmacy->email = $request->email;
        } else {
            abort(403); // user is not authorized to update this pharmacy
        }
    }
        
        $pharmacy->save();
        return redirect()->route('pharmacy.index')->with(['Pharmacy updated successfully']);*/

    }

    public function destroy( $id)

    {
        $user = Auth::user();
        $pharmacy = Pharmacy::withTrashed()->findOrFail($id);

        if ($user->can('manage-pharmacies')) {
           
            if ($pharmacy->trashed()) {
                $pharmacy->restore();
                return redirect()->route('pharmacy.index')->with('success', 'Pharmacy restored successfully!');
            }
        
            $pharmacy->delete();
        
            return redirect()->route('pharmacy.index')->with('success', 'Pharmacy deleted successfully!');
           } 
         else {
            abort(403,'unauthorized action');
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

    return redirect()->route('pharmacy.index')->with(['success'=>'Pharmacy Restored successfully']);
       } 
     else {
        abort(403,'unauthorized action');
    }
    
    
}

public function banDoctor(Request $request, Pharmacy $pharmacy, Doctor $doctor)
    {
        $user = Auth::user();
        
        if ($user->can('manage-pharmacies') || ($user->can('manage-own-doctors'))) {
        
    
            $pharmacy->ban($doctor, $request->input('reason'), $request->input('expired_at'));

    
            return redirect()->back()->with('success', 'Doctor banned successfully.');
    
        } else {
            // User does not have permission to edit pharmacy
            abort(403,'unauthorized action');
        }
        
        
        
        /*$this->authorize('ban', [$pharmacy, $doctor]);

        $pharmacy->ban($doctor, $request->input('reason'), $request->input('expired_at'));

        return redirect()->back()->with('success', 'Doctor banned successfully.');*/
    }

    public function unbanDoctor(Pharmacy $pharmacy, Doctor $doctor)
    {
        $this->authorize('unban', [$pharmacy, $doctor]);

        $pharmacy->unban($doctor);

        return redirect()->back()->with('success', 'Doctor unbanned successfully.');
    }


}

