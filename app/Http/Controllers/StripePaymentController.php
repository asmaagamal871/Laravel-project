<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use Session;
use Stripe;
use DB;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    { 
         Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // $order_id=$request->order_id;
        //  $amount = DB::table("medicines") ->select(DB::raw("SUM((medicines.price)* order_include_medicine.qty) as total_price"))
        //     ->leftjoin("order_include_medicine","order_include_medicine.medicine_id","=","medicines.id")->where('order_include_medicine.order_id',$order_id)->first();
        //    $userObj = DB::table('users')->where('id', '=', $request->userId)->first();

        //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // $token = $_POST['stripeToken'];

        // $customer = \Stripe\Customer::create(array(
        //     "email" => $userObj->email,
        //     "card" => $token,
        // ));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
                // "amount" => $amount->total_price,

                // "currency" => "usd",
    
                // "description" => "Order ID IS " .$request->order_id ,
    
                // "customer" =>  $customer->id
        ]);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
}