<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use Illuminate\Http\Request;
use Session;
class PricingPlanController extends Controller
{


   


   
   public function index()
{ if(Session::get('adminId')){
    $data = Plan::orderBy('id','DESC')->paginate(10);
                
       $distinctPlanCategories = Plan::distinct()->pluck('plan_category');         

    return view('admin.upgrade.index', compact('data','distinctPlanCategories'));
 }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}


    public function create()
    {
        if(Session::get('adminId')){
       $data = Plan::all();
        return view('admin.upgrade.add',compact('data'));
     }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}

    
    public function store(Request $request)
    {
          if(Session::get('adminId')){
     
      $data= new Plan;
      
      
       
       $data->plan_name= $request->plan_name;
      $data->price= $request->price;
      $data->period= $request->period;
      $data->list1= $request->list1;
      $data->list2= $request->list2;
     $data->list3= $request->list3;
      $data->list4= $request->list4;
       $data->list5= $request->list5;
     
           $data->save();
       
if($data->save()){
       
        return redirect()->route('plan.index')->with('Message', 'Plan added successfully!');
    }
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    } }


     public function edit($id)
{
      if(Session::get('adminId')){
    $data = Plan::find($id);
    
    
    return view('admin.upgrade.edit', compact('data'));
 }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}

    
public function update(Request $request, $id)
{
       if(Session::get('adminId')){
    $data = Plan::find($id);
    $originalValues = $data->toArray(); // Corrected from $row to $data

    $data->plan_name = $request->get('plan_name');
    $data->price = $request->get('price');
    $data->period = $request->get('period');
    $data->list1 = $request->get('list1');
    $data->list2 = $request->get('list2');
    $data->list3 = $request->get('list3');
    $data->list4 = $request->get('list4');
    $data->list5 = $request->get('list5');
   

    $updatedFields = array_diff_assoc($data->toArray(), $originalValues);

    if (empty($updatedFields)) {
        return redirect()->route('plan.index')->with('Message', 'No changes were made.');
    }

    if ($data->save()) {
        return redirect()->route('plan.index')->with('Message', 'Plan Updated Successfully');
   

 }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}
}

 
    public function destroy($id)
    {
            if(Session::get('adminId')){
        $data = Plan::find($id);
        if ($data->delete()){
         return redirect()->back()->with('Message', "Plan deleted successfully.");
        }
        else{
         return redirect()->back()->with('Error', "Something went wrong.");
        }
 }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
    }
    




}
