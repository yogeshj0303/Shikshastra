<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Category;
use Session;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Session::get('adminId')){
        $location  = Subject::join('categories', 'subjects.class_id', '=', 'categories.id')
        ->orderBy('subjects.id', 'DESC')
        ->select('subjects.*', 'categories.name as category_name')
        ->paginate(10);
        
        return view('admin.subject.index',compact('location'));
     }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }  }

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
         'subject_name' => 'required',
         'class_id' => 'required',
      
    ]);
        $data= new Subject;
        $data->subject_name = $request->subject_name;
        $data->class_id = $request->class_id;
        if($data->save()){
            return redirect()->back()->with('Message', 'Subject added successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }   }

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
     { if(Session::get('adminId')){
        $data = Subject::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('Message', 'Subject deleted successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }   }
}
