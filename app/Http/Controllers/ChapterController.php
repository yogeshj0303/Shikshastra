<?php

namespace App\Http\Controllers;
use App\Models\Chapter;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get('adminId')){
       $location  =  DB::table('chapters')
       ->join('categories', 'chapters.class_id', '=', 'categories.id')
       ->join('subjects', 'chapters.subject_id', '=', 'subjects.id')
       ->select('chapters.*', 'categories.name AS class_name', 'subjects.subject_name AS subject_name')
       ->paginate(10);
       
       return view('admin.chapter.index',compact('location'));
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
         'subject_id' => 'required',
         'class_id' => 'required',
         'chapter_name' => 'required',
      
    ]);
        $data= new Chapter;
        $data->subject_id = $request->subject_id;
        $data->class_id = $request->class_id;
        $data->chapter_name = $request->chapter_name;
        if($data->save()){
            return redirect()->back()->with('Message', 'Chapter added successfully !!');

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
    { 
        if(Session::get('adminId')){
        $data = Chapter::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('Message', 'Chapter deleted successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }   }
}
