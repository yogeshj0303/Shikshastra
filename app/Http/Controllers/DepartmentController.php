<?php

namespace App\Http\Controllers;
use App\Models\Department;


use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location  = Department::all();
      
        return view('admin.department.index',compact('location'));
    }

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
        $data= new Department;

        $data->name = $request->name;
         $image = $request->file('image');

            $ext = $image->getClientOriginalExtension();

            $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

            $image->move('uploads/category/', $image_name);

            $data->image = $image_name;
        if($data->save()){
            return redirect()->back()->with('Message', 'Department added successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
    }

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
    {
        $data = Department::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('Message', 'Department deleted successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
    }
}
