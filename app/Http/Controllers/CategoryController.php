<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Session;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Session::get('adminId')){
        $data = Category::orderBy('id','DESC')->paginate(8);
        return view('admin.job-category.form',compact('data'));
         }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
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
       if(Session::get('adminId')){  
          $request->validate([
            'name' => 'required|regex:/^[A-Za-z0-9\s\-]+$/|unique:categories,name',
       
    ]);
        $data = new Category;
        $data->name = $request->name;
        
    
        
        if($data->save()){
            return redirect()->route('category.index')->with('Message', "Category upload successfully.");
        }
        else{
            return redirect()->back()->with('error', "Something went wrong.");
        }
   }
    else{
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
        $company= Category::find($id);
        return view('admin.job-category.edit',compact('company'));
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
         $request->validate([
              'name' => 'required|regex:/^[A-Za-z0-9\s\-]+$/',
]);
        $data =Category::find($id);
      
        $data->name = $request->name;
        
            
        if($data->save()){
          return redirect()->route('category.index')->with('Message', "Category Update Successfully.");
        }
        else{
            return redirect()->back()->with('Error', "Something went wrong.");
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         if(Session::get('adminId')){
        $data = Category::find($id);
        if($data){
            $cat=DB::table('preferences')->where('category_id',$id)->delete();
             $job=DB::table('jobs')->where('category_id',$id)->delete();
              $intern=DB::table('internships')->where('category_id',$id)->delete();
       if ($data->delete()){
        return redirect()->back()->with('Message', "Category deleted successfully.");
       }
        }
       else{
        return redirect()->back()->with('error', "Something went wrong.");
       }

     }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}
}
