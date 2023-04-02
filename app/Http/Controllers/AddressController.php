<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
    $alladdress=Address::all();

    //   dd($alladdress);
   return view('addresses.index', ['addresses' => $alladdress]);
    }

//   //============================================show======================================
  public function showAddress($id)
  {
     $address=Address::find($id);
     
     return view('addresses.show', ['address' => $address]);
  }
//   //==========================================create==================================
public function createAddress()
  {
$users=User::all();
$areas=Area::all();
   return view('addresses.create',['users'=>$users,'areas'=>$areas]);
  }
//   //=============================================store=================================================================
  public function storeAddress(Request $request)
  {
     $st_name=request()->st_name;
     $building_no=request()->building_no;
     $floor_no=request()->floor_no;
     $flat_no=request()->flat_no;
     $is_main=request()->radio;
    $area_id=request()->area_id;
    $user_id=request()->user_id;

    // dd($name,$type,$price)
    

    Address::create([
          'st_name' => $st_name,
          'building_no' => $building_no,
          'floor_no' => $floor_no,
           'flat_no' => $flat_no,
          'is_main' => $is_main,
          'area_id'=>$area_id,
          'user_id'=>$user_id,

      ]);

      return to_route(route:'addresses.index');
  }
//  //===========================================edit=====================================================
  public function editAddress($address)
  {
    $address =Address::find($address);
    $users=User::all();
    $areas=Area::all();
      return view('addresses.edit', ['address'=>$address,'users'=>$users,'areas'=>$areas]);
  
  }
// //==============================================update============================================
  public function updateAddress( $id,Request $request)
  {
 
     $address = Address::find($id);

 
$address->update([

'st_name' =>$request->st_name,
'building_no' => $request->building_no,
'floor_no' =>$request-> floor_no,
'flat_no' =>$request->flat_no,
'is_main' =>$request->radio,
'area_id' =>$request->area_id,
'user_id' =>$request->user_id,

]);
   return to_route(route:'addresses.index');

  }
//   //=================================================delete================================================
  public function destoryAddress($id)
  {
   
  $address= Address::where('id', $id);
  

    $address->delete();
    return to_route(route:'addresses.index');
   
  }
}
