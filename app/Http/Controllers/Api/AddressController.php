<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user()->typeable->id;
        // dd($user);
        $address = Address::create([
            'st_name' =>  $request->st_name,
            'building_no' => $request->building_no,
            'floor_no' => $request->floor_no,
            'flat_no'=>$request->flat_no,
            'is_main'=>$request->is_main,
            'area_id'=>$request->area_id,
            'end_user_id'=>$user,
        ]);
        return new AddressResource($address);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user()->typeable->id;
        dd($user);
        $address=Address::find($id);

        if ($address->end_user_id==$user) {
            if ($request->st_name&&($address->st_name != $request->st_name)) {
                $address->st_name =  $request->st_name;
            }
            if ($request->building_no&&($address->building_no != $request->building_no)) {
                $address->building_no =  $request->building_no;
            }
            if ($request->floor_no&&($address->floor_no != $request->floor_no)) {
                $address->floor_no =  $request->floor_no;
            }
            if ($request->flat_no&&($address->flat_no != $request->flat_no)) {
                $address->flat_no =  $request->flat_no;
            }
            if ($request->is_main&&($address->is_main != $request->is_main)) {
                $address->is_main =  $request->is_main;
            }

            $address->save();
            return new AddressResource($address);
        }else{
            return "not allowed";
        }
    }

    public function index()
    {
        $user = Auth::user()->typeable->id;
        $addresses=Address::all()->where('end_user_id', $user);
        if ($addresses) {
            return AddressResource::collection($addresses);
        } else {
            return "no addresses";
        }
    }

    public function destroy($id)
    {
            $address=Address::find($id);
            $user = Auth::user()->typeable->id;
            // dd($user);
        if($address->end_user_id==$user){
            $address->delete();
            return 'deleted successfully';
        }
        else{
            return 'unathorized action';

        }
        
    }
}
