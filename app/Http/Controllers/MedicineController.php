<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    //============================================index============================================
    public function index()
    {
    $allmedicine=Medicine::all();

       //dd($allmedicine);
    return view('medicines.index', ['medicines' => $allmedicine]);
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
    public function storeMedicine(Request $request)
    {
       $name=request()->name;
       $type=request()->type;
       $price=request()->price;
      // dd($name,$type,$price)
      

        Medicine::create([
            'name' => $name,
            'type' => $type,
            'price' => $price,
         

        ]);

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
   
$medicine->update([
  'name'=>$request->name,
  'type'=>$request->type,
  'price'=>$request->price

]);
     return to_route(route:'medicines.index');

    }
  //   //=================================================delete================================================
    public function destoryMedicine($id)
    {
     
    $medicine= Medicine::where('id', $id);
    

      $medicine->delete();
      return to_route(route:'medicines.index');
     
    }
}
