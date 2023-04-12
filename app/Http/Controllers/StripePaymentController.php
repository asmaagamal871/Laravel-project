<?php
    
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Session;
use Stripe;
     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($id)
    {
        $order = Order::where('id', $id)->first();
        // dd($order);
        return view('stripe', compact('order'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $order_id=$request->order_id;
        $order = Order::where('id', $order_id)->first();
        $order->status="confirmed";
        $order->save();
        return view('confirm');
    }
}