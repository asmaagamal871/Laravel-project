<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Pharmacy;
use App\Models\User;
use App\Models\Address;
use Illuminate\Console\Scheduling\Schedule;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */




    public function index()
    {
        $user = Auth::user();
        if ($user->can('manage-doctors')) {




            $doctor = Doctor::all();

            return view('doctors.index', ['doctors' => $doctor]);
        } else if ($user->can('manage-own-doctors')) {
            $doctor = Doctor::all();

            return view('doctors.index', ['doctors' => $doctor]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }







    public function create()
    {
        $user = Auth::user();
        if ($user->can('manage-doctors')) {


            $pharmacies = Pharmacy::all();
            return view('doctors.create', ['pharmacies' => $pharmacies]);
        } else if ($user->can('manage-own-doctors')) {
            $pharmacies = Pharmacy::all();
            return view('doctors.create', ['pharmacies' => $pharmacies]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }



    public function store(Request $data)
    {
        $path = 'public/doctors/default.png';
        if ($data['avatar']) {
            $path = Storage::putFileAs(
                'public/doctors',
                request()->file('avatar'),
                request()->file('avatar')->getClientOriginalName()
            );
        }
        $user = Auth::user();
        if ($user->can('manage-doctors')) {


            $newUser = Doctor::factory()->create(
                [

                    'image' => $path,
                    'national_id' => $data['national_id'],
                    'pharmacy_id' => $data['pharmacy']
                ]
            );
        } else if ($user->can('manage-own-doctors')) {
            $newUser = Doctor::factory()->create(
                [

                    'image' => $path,
                    'national_id' => $data['national_id'],
                    'pharmacy_id' => $user->typeable->id
                ]
            );
        }



        $mainUser = User::factory()->create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'typeable_type' => 'doctor',
                'typeable_id' => $newUser->id
            ]
        );

        $newUser->type()->save($mainUser);
        $newUser->assignRole('doctor');
        $newUser->givePermissionTo(['update-order-status']);
        return redirect()->route('doctors.index');
    }









    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        if ($user->can('manage-doctors')) {




            $doctor = Doctor::where('id', $id)->first();
            // dd($doctors);
            return view('doctors.show', ['doctors' => $doctor]);
        } else if ($user->can('manage-own-doctors')) {
            $doctor = Doctor::where('id', $id)->first();
            // dd($doctors);
            return view('doctors.show', ['doctors' => $doctor]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)

    {
        $user = Auth::user();
        if ($user->can('manage-doctors')) {

            $doctor = Doctor::find($id);
            return view('doctors.edit', ['doctor' => $doctor]);
        } else if ($user->can('manage-own-doctors')) {
            $doctor = Doctor::find($id);
            return view('doctors.edit', ['doctor' => $doctor]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }




    public function update(Request $request, $id)
    {

        $user = Auth::user();
        if ($user->can('manage-doctors')) {
            
        
        $doctor = Doctor::find($id);
        // dd($doctor);
        $doctor->national_id = $request->national_id;
         $doctor->type->name = $request->name;
        $doctor->type->email = $request->email;
         $doctor->type->password = $request['password'];
         $doctor->save();


        $doctor->type->save();
        return redirect()->route('doctors.index')->with(['updated successfully']);}

        else if($user->can('manage-own-doctors'))
        {
            $doctor = Doctor::find($id);
        // dd($doctor);
         $doctor->type->name = $request->name;
         $doctor->type->email = $request->email;
         $doctor->type->password = $request['password'];
         $doctor->national_id = $request->national_id;
         $doctor->save();

        $doctor->type->save();
        return redirect()->route('doctors.index')->with(['updated successfully']);

        }
        else {
            abort(403, 'Unauthorized action.');
        }}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    
{
    $user = Auth::user();
           if ($user->can('manage-doctors')) {


    $doctor = Doctor::findOrFail($id); // find the doctor by its ID
    $doctor->delete(); // delete the doctor
    return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
}



else if ($user->can('manage-own-doctors')) {

    $doctor = Doctor::findOrFail($id); // find the doctor by its ID
    $doctor->delete();
    return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');

}

else {

    abort(403, 'Unauthorized action.');
}}
}






















        
        
        
        
        
        
        
        
        
        
        
        
//         $user = Auth::user();
//         if ($user->can('manage-doctors')) {

// Doctor::where(['id' => $id])->delete();

//             return redirect()->route('doctors.index')->with(['success' => 'deleted successfully']);
//         } else if ($user->can('manage-own-doctors')) {


//             Doctor::where(['id' => $id])->delete();
//             return redirect()->route('doctors.index')->with(['success' => 'deleted successfully']);
//         } else {
//             abort(403, 'Unauthorized action.');
//         }
//     }
// }
