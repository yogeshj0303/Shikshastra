<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Session;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
 
    public function index()
    {
        if(Session::get('adminId')){
        $reviews  = Review::all();
        
        return view('admin.testimonial.index',compact('reviews'));
    
        }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }   
        }


    public function create()
    {if(Session::get('adminId')){
        $reviews  = Review::all();
        
        return view('admin.testimonial.create',compact('reviews'));
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
    }


   public function store(Request $request)
{
    if(Session::get('adminId')){
    // Validate the request data
    $request->validate([
         'name' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
        'description' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png,avif',
    ]);

    // Create a new Review instance and populate its fields
    $data = new Review;
    $data->name = $request->name;
    $data->date = $request->date;
    $data->description = $request->description;

    // Handle the image file upload
    if ($request->hasfile('image')) {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;
        $image->move('uploads/images/', $image_name);
        $data->image = $image_name;
    }

    // Save the Review instance to the database
    if ($data->save()) {
        return redirect('reviews')->with('Message', 'Review added successfully !!');
    } else {
        return redirect('reviews')->with('Error', 'Something went wrong !!');
    }
 }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}



    public function destroy($id)
    {
        if(Session::get('adminId')){
        $data = Review::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('Message', 'Review deleted successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    } }
}
