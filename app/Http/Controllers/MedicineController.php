<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicineRequest;
use App\Models\Medicine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MedicineController extends Controller
{
    //============================================index============================================
    public function index()
    {
      $user = Auth::user();
        
     if ($user->can('manage-medicines')) {
 
   //select * from posts
    $allmedicine=Medicine::all();
    return view('medicines.index', ['medicines' => $allmedicine]);
      }
       //dd($allmedicine);
   
    }
  //   //============================================show======================================
    public function showMedicine($id)
    {
       $medicine=Medicine::find($id);
       return view('medicines.show', ['medicine' => $medicine]);
    }
  //   //==========================================create==================================
  public function createMedicine()
    {

     return view('medicines.create');
    }
  //   //=============================================store=================================================================
    public function storeMedicine(StoreMedicineRequest $request)
    {
      $valid_request = $request->validated();

       $name=request()->name;
       $type=request()->type;
       $price=request()->price;
      // dd($name,$type,$price)
         $user = Auth::user();
        
     if ($user->can('manage-medicines')) {

        Medicine::create([
            'name' => $name,
            'type' => $type,
            'price' => $price,
         

        ]);
      }

        return to_route(route:'medicines.index');
    }
  //  //===========================================edit=====================================================
    public function editMedicine($medicine)
    {
      $medicine = Medicine::find($medicine);
        return view('medicines.edit', ['medicine'=>$medicine]);
    
    }
  // //==============================================update============================================
    public function updateMedicine( $id,Request $request)
    {
     
       // $post = Post::where('id', $id)->first();
       $medicine = Medicine::find($id);

      //  $medicine->name = $request->input('name');
      //  $medicine->type = $request->input('type');
      //  $medicine->price = $request->input('price');
      $user = Auth::user();
        
     if ($user->can('manage-medicines')) {
$medicine->update([
  'name'=>$request->name,
  'type'=>$request->type,
  'price'=>$request->price

]);}
     return to_route(route:'medicines.index');

    }
  //   //=================================================delete================================================
    public function destoryMedicine($id)
    {
     
    $medicine= Medicine::where('id', $id);
    $user = Auth::user();
        
  

      $medicine->delete();
   
      return to_route(route:'medicines.index');
     
    }
}
