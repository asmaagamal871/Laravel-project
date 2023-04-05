<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\Area;
use App\Models\User;
use App\Models\EndUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
  public function index()
  {
    $user = Auth::user();
   

    if ($user->can('manage-own-addresses')) { //user is admin or end user
      
      if ($user->can('manage-addresses')) { //if admin
        $alladdress = Address::all();
        return view('addresses.index', ['addresses' => $alladdress]);
      } else { //if end user
        $alladdress = $user->typeable->addresses()->get();
        return view('addresses.index', ['addresses' => $alladdress]);
      }
    } else {
      abort(403, 'Unauthorized action.');
    }


    // if($alladdress){

    //   return view('addresses.index', ['addresses' => $alladdress]);
    // }
    // else{
    // if ($user->can('manage-addresses')) {
    //   $alladdress = Address::all();
    //   return view('addresses.index', ['addresses' => $alladdress]);
    // }
    // else{
    //   abort(403, 'Unauthorized action.');
    // }

    //}
    //   dd($alladdress);

  }

  //   //============================================show======================================
  public function showAddress($id)
  {
    $address = Address::find($id);

    return view('addresses.show', ['address' => $address]);
  }
  //   //==========================================create==================================
  public function createAddress()
  {
    $EndUsers = EndUser::all();
    $users = User::all();
    $areas = Area::all();
    return view('addresses.create', ['users' => $users, 'EndUsers' => $EndUsers, 'areas' => $areas]);
  }
  //   //=============================================store=================================================================
  public function storeAddress(StoreAddressRequest $request)
  {
    //name in input
    $valid_request = $request->validated();

    $user = Auth::user();

    $st_name = request()->st_name;
    $building_no = request()->building_no;
    $floor_no = request()->floor_no;
    $flat_no = request()->flat_no;
    $is_main = request()->radio;
    $area_id = request()->area_id;

    if ($user->can('manage-addresses')) {
      $end_user_id = request()->user_id;
      Address::create([
        //name of col //
        'st_name' => $st_name,
        'building_no' => $building_no,
        'floor_no' => $floor_no,
        'flat_no' => $flat_no,
        'is_main' => $is_main,
        'area_id' => $area_id,
        'end_user_id' => $end_user_id,

      ]);
    } elseif ($user->can('manage-own-addresses')) {
      Address::create([
        //name of col //
        'st_name' => $st_name,
        'building_no' => $building_no,
        'floor_no' => $floor_no,
        'flat_no' => $flat_no,
        'is_main' => $is_main,
        'area_id' => $area_id,
        'end_user_id' => $user->typeable->id,

      ]);
      
    }
    else {
      abort(403, 'Unauthorized action.');
    }
    

    return to_route(route: 'addresses.index');
  }
  //  //===========================================edit=====================================================
  public function editAddress($address)
  {
    $EndUsers = EndUser::all();
    $address = Address::find($address);
    $users = User::all();
    $areas = Area::all();
    return view('addresses.edit', ['address' => $address, 'EndUsers' => $EndUsers, 'users' => $users, 'areas' => $areas]);
  }
  // //==============================================update============================================
  public function updateAddress($id, Request $request)
  {

    $address = Address::find($id);

    $user = Auth::user();
    if ($user->can('manage-addresses')) {
      $address->update([

        'st_name' => $request->st_name,
        'building_no' => $request->building_no,
        'floor_no' => $request->floor_no,
        'flat_no' => $request->flat_no,
        'is_main' => $request->radio,
        'area_id' => $request->area_id,
        'end_user_id' => $request->user_id,

      ]);
    } elseif ($user->can('manage-own-addresses')) {
      $address->update([

        'st_name' => $request->st_name,
        'building_no' => $request->building_no,
        'floor_no' => $request->floor_no,
        'flat_no' => $request->flat_no,
        'is_main' => $request->radio,
        'area_id' => $request->area_id,


      ]);
    }
    else {
      abort(403, 'Unauthorized action.');
    }
    return to_route(route: 'addresses.index');
  }
  //   //=================================================delete================================================
  public function destoryAddress($id)
  {

    $address = Address::where('id', $id);
  //user is admin or end user
  $user = Auth::user();
  if ($user->can('manage-addresses')) { 

    $address->delete();}
    else if('manage-own-addresses'){
      $address->delete();
    }
    else {
      abort(403, 'Unauthorized action.');
    }
    return to_route(route: 'addresses.index');
  }
}
