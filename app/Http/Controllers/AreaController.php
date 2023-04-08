<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;



class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('manage-areas')) {

            $area = Area::all(); //select * from posts
            // dd($doctor);
            return view('areas.index', ['areas' => $area]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->can('manage-areas')) {


            $areas = Area::all();

            return view('areas.create', ['areas' => $areas]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        if ($user->can('manage-areas')) {


            $area = new Area();
            $area->name = $request->name;
            //$area->address = $request->address;


            $area->save();
            return redirect()->route('areas.index')->with(['created successfully']);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        if ($user->can('manage-areas')) {


            $area = Area::where('id', $id)->first();
            // dd($doctors);
            return view('areas.show', ['areas' => $area]);
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
        if ($user->can('manage-areas')) {


            $area = Area::find($id);
            return view('areas.edit', ['area' => $area]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->can('manage-areas')) {

            $area = Area::find($id);
            // dd($doctor);

            $area->name = $request['name'];
            //$area->address = $request['address'];

            //$area->password=$request['password'];


            $area->save();
            return redirect()->route('areas.index')->with(['updated successfully']);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id ) //areamodeltype
    
        {
                    $user = Auth::user();
         if ($user->can('manage-areas')) {


            
            

    $area = Area::findOrFail($id); // find the area by its ID
    $area->address()->delete(); // delete all related addresses
    $area->delete(); // delete the area
    return redirect()->route('areas.index')->with('success', 'Area and addresses deleted successfully.');
}



          else {
             abort(403, 'Unauthorized action.');
         }

         
        }
    }



























//         $user = Auth::user();
//         if ($user->can('manage-areas')) {

//             Area::where(['id' => $id])->delete();


            





//             //kol l adresses w ams7hom bl id bt3hom whnms7 l pharmacies ay order status bta3o new 
//             //having same adress ems7o
//             return redirect()->route('areas.index')->with(['success' => 'deleted successfully']);
//         } else {
//             abort(403, 'Unauthorized action.');
//         }
//     }
// }
// //abort(403, 'Unauthorized action.');
