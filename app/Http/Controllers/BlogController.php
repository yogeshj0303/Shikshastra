<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function indexFront(Request $request)
    {
         
        $data=DB::table('blogs')
        ->leftjoin('blogcategories','blogcategories.id','=','blogs.category_id')
        ->where('blogs.id',$request->id)->select('blogs.*','blogcategories.id as bid','blogcategories.*','blogs.id as id')->first();
      
        return view('Front-end.more-blogs',compact('data'));
     }

     
     
    public function index()
    {
         if(Session::get('adminId')){
        $data=DB::table('blogs')->leftjoin('blogcategories','blogcategories.id','=','blogs.category_id')
        ->select('blogs.*','blogcategories.*','blogcategories.id as cat_id','blogs.id as id')->orderBy('blogs.id','DESC')->paginate(5);;
      
        return view('admin.blog.index',compact('data'));
     }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {if(Session::get('adminId')){
       return view('admin.blog.create');
     }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      if(Session::get('adminId')){  
 

            $data = new Blog;
            $data->title = $request->title;
            $data->description = $request->description;
            $data->company = $request->company;
             $data->upload_user_id = $request->upload_user_id;
            $data->note = $request->note;
     $data->category_id = $request->category_id;
            if ($request->hasfile('image')) {



                $image = $request->file('image');

                $ext = $image->getClientOriginalExtension();

                $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

                $image->move('uploads/blog/', $image_name);

                $data->image = $image_name;

            }
            if($data->save()){
                return redirect('blog')->with('Message', "You have submit Blog Successfully.");
            }
            else{
                return redirect()->back()->with('Error', "Something went wrong.");
            }


    }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}
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
         if(Session::get('adminId')){  
        $data=Blog::find($id);
     return view('admin.blog.edit',compact('data'));
    }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
     {
         if(Session::get('adminId')){  
        
 

            $data=Blog::find($id);
            $data->title = $request->title;
            $data->description = $request->description;
            $data->category_id = $request->category_id;
            $data->company = $request->company;
             $data->upload_user_id = $request->upload_user_id;
            $data->note = $request->note;

            if ($request->hasfile('image')) {



                $image = $request->file('image');

                $ext = $image->getClientOriginalExtension();

                $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

                $image->move('uploads/blog/', $image_name);

                $data->image = $image_name;

            }
            if($data->save()){
                return redirect('blog')->with('Message', "You have Updated Blog Successfully.");
            }
            else{
                return redirect()->back()->with('Error', "Something went wrong.");
            }

}
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
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
           if(Session::get('adminId')){  
        $data = Blog::find($id);
        if ($data->delete()){
         return redirect()->back()->with('Message', "blog deleted successfully.");
        }
        else{
         return redirect()->back()->with('Error', "Something went wrong.");
        }
   }
    else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    } }
}
