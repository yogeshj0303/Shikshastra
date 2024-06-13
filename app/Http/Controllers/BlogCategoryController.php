<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogcategory;
use Illuminate\Support\Facades\DB;
use Session;
class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Session::get('adminId')){
        $data = Blogcategory::orderBy('id','DESC')->paginate(10);
        return view('admin.blog-category.form',compact('data'));
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
                'name' => 'required|regex:/^[A-Za-z\s\-]+$/|unique:categories,name',
       
             
    ]);
        $data = new Blogcategory;
        $data->name = $request->name;
        
      
        
        if($data->save()){
            return redirect()->route('blog-category.index')->with('Message', "Blog Category added successfully.");
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
        //
         if(Session::get('adminId')){
        $data = Blogcategory::find($id);
        if($data){
            $cat=DB::table('blogs')->where('category_id',$id)->delete();
            
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
