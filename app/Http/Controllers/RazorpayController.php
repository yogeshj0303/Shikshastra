<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use App\Models\Plan;
use Carbon\Carbon;
use App\Models\Subscription;
use Redirect;

class RazorpayController extends Controller
{
    public function razorpay(Request $request)
    {        
        $data = Plan::where('id',$request->id)->first();
        return view('index',compact('data'));
    }

    public function payment(Request $request)
    {        
        $input = $request->all(); 
       
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
              $order_id = 'ORD' . rand(1000, 9999);
               $currentDate = Carbon::now();
        $user = session()->get('user_id');
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                $upgradeData = new Subscription;
                $upgradeData->plan_id=$input['plan_idd'];
                $upgradeData->user_id=$user;
                 $upgradeData->purchase_date = $currentDate;
                 $upgradeData->order_id = $order_id;
                 $upgradeData->save();

            } 
            catch (\Exception $e) 
            {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }            
        }
        
        \Session::put('success', 'Payment successful');
        return redirect('/')->with('success', 'Payment successful');
    }
}