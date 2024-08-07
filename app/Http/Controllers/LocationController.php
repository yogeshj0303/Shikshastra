<?php

namespace App\Http\Controllers;
use App\Models\Location;
use Illuminate\Http\Request;
use Session;
class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('adminId')){
        $location= Location::orderBy('id','DESC')->paginate(10);
        return view('admin.location.index',compact('location'));
      }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Session::get('adminId')){
                  $request->validate([
                       'location' => 'required|regex:/^[A-Za-z\s\-]+$/|unique:locations,location',
       
      
    ]);
        $data = new Location;
        $data->location = $request->location;
        $data->save();
        if($data)
        {
            return redirect()->route('location.index')->with('Message','Location added successfully.');
        }
        else{
            return redirect()->route('location.index')->with('Error','Something went wrong.');
        }

    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    } }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {if(Session::get('adminId')){
        $data = Location::find($id);
        if ($data->delete()){
         return redirect()->back()->with('Message', "Location deleted successfully.");
        }
        else{
         return redirect()->back()->with('Error', "Something went wrong.");
        }

     }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    } }

}
