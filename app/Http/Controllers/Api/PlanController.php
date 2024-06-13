<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PlanController extends Controller

{


public function showPlan(Request $request)
{
    $plan = Plan::all();

    if ($plan->isEmpty()) {
        return response()->json([
            'message' => 'No plans available',
            'error' => true
        ], 404);
    }
$plan->transform(function ($plan) {
    $plan->list = explode(',', $plan->list);
    return $plan;
});
      return response()->json([
          'data'=>$plan,
            'message' => 'All plans fetch Successfully!!!',
            'error' => false
        ], 200);
}

    public function store(Request $request)
    {
        try {
            
    

            $data = new Plan;
            $data->plan_name = $request->plan_name;
            $data->plan_title = $request->plan_title;
            $data->plan_sub_title = $request->plan_sub_title;
            $data->discount = $request->discount;
            $data->discount_price = $request->discount_price;
            $data->duration = $request->duration;
            $data->price = $request->price;
            $data->plan_category = $request->plan_category;

            if ($request->has('moreFields')) {
                // Initialize an array to store the "list" values
                $listValues = [];

                // Loop through each "moreFields" entry
                foreach ($request->input('moreFields') as $moreField) {
                    // Check if "list" exists in the current "moreField"
                    if (isset($moreField['list'])) {
                        // Add the "list" value to the listValues array
                        $listValues[] = $moreField['list'];
                    }
                }

                // Implode the listValues array into a single string and assign it to the "list" field
                $data->list = implode(',', $listValues);
            }

            $data->save();

                return redirect()->route('plan.index')->with('Message', 'Plan added successfully');

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to store the plan data'], 500);
        }
    }
    
    
    
     public function update(Request $request, $id)
    {
        try {
            
            $data =Plan::find($id);
            $data->plan_name = $request->plan_name;
            $data->plan_title = $request->plan_title;
            $data->plan_sub_title = $request->plan_sub_title;
            $data->discount = $request->discount;
            $data->discount_price = $request->discount_price;
            $data->duration = $request->duration;
            $data->price = $request->price;
            $data->plan_category = $request->plan_category;

            if ($request->has('moreFields')) {
                // Initialize an array to store the "list" values
                $listValues = [];

                // Loop through each "moreFields" entry
                foreach ($request->input('moreFields') as $moreField) {
                    // Check if "list" exists in the current "moreField"
                    if (isset($moreField['list'])) {
                        // Add the "list" value to the listValues array
                        $listValues[] = $moreField['list'];
                    }
                }

                // Implode the listValues array into a single string and assign it to the "list" field
                $data->list = implode(',', $listValues);
            }

            $data->save();

                return redirect()->route('plan.index')->with('Message', 'Plan update successfully');

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to store the plan data'], 500);
        }
    }



    public function subPlan(Request $request)
    {
        $user_id = $request->user_id;
        $plan_id = $request->plan_id;
       $user = User::find($user_id);
     
           if (!$user) {
            return response()->json(['error' => true, 'message' => 'User not found']);
        }
      
         // Check if the plan exists
        $plan = Plan::find($plan_id);

        if (!$plan) {
            return response()->json(['error' => true, 'message' => 'Plan not found']);
        }
        // Check if the user has already purchased the plan
        $existingSubscription = Subscription::where('user_id', $user_id)
            ->where('plan_id', $plan_id)
            ->first();


        if ($existingSubscription) {
            return response()->json(['error' => true, 'message' => 'Plan Already Purchased']);
        }

     

        // Generate a unique order ID
        $order_id = 'ORD' . rand(1000, 9999);

        // Get the current date and time
        $currentDate = Carbon::now();

        // Create a new subscription record
        $newSubscription = new Subscription;
        $newSubscription->user_id = $user_id;
        $newSubscription->plan_id = $plan_id;
        $newSubscription->purchase_date = $currentDate;
        $newSubscription->order_id = $order_id;

        // Save the subscription to the database
        if ($newSubscription->save()) {
            // Update the user's subscription status
            DB::table('users')
                ->where('id', $user_id)
                ->update(['sub_status' => 1,
                'plan_id'=>$plan_id,]);

            return response()->json(['error' => false, 'message' => 'Plan Purchased Successfully']);
        } else {
            return response()->json(['error' => true, 'message' => 'Plan not purchased']);
        }
    }

    public function showPlanStatus(Request $request)
    {
        $user_id = $request->user_id;

        // Retrieve the subscription status of the user
        $subscription = DB::table('users')->where('id', $user_id)->select('sub_status')->first();

        // Check if the user exists
        if (!$subscription) {
            return response()->json([
                'message' => 'User not found',
                'error' => true
            ], 404);
        }

        return response()->json([
            'data' => $subscription,
            'message' => 'Subscription Status fetched successfully',
            'error' => false
        ], 200);
    }

      
    

    
    
    
    public function destroy(Request $request, $id)
{
    $deletedRows = DB::table('plans')->where('id', $id)->delete();

    if ($deletedRows > 0) {
        return redirect()->back()->with('Message', "Plan deleted successfully.");
    } else {
        return redirect()->back()->with('Error', "Something went wrong.");
    }
}







}

