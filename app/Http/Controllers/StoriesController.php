<?php

namespace App\Http\Controllers;
use App\Models\Story;
use App\Models\Category;
use Session;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
 public function frontindex($id){
      $st  = Story::where('id',$id)->first();
        
        return view('Front-end.story',compact('st'));
        
 }
    public function index()
    {
        if(Session::get('adminId')){
        $stories  = Story::orderBy('id','DESC')->paginate(8);
        
        return view('admin.stories.index',compact('stories'));
     }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}


    public function create()
    {
         if(Session::get('adminId')){
        $stories  = Story::all();
        
        return view('admin.stories.create',compact('stories'));
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    } }


  public function store(Request $request)
{
     if(Session::get('adminId')){
  $request->validate([
         'heading' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
        'description' => 'required',
        'image' => 'required|mimes:jpg,jpeg,png,avif',
    ]);

    $data = new Story;
    $data->heading = $request->heading;
    $data->date = date("j F Y", strtotime($request->date));
    $data->description = $request->description;

    if ($request->hasfile('image')) {
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;
        $image->move('uploads/images/', $image_name);
        $data->image = $image_name;
    }

    if ($data->save()) {
        return redirect('stories')->with('Message', 'Stories added successfully !!');
    } else {
        return redirect('stories')->with('Error', 'Something went wrong !!');
    }
     }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
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

     public function edit($id)
{
    if(Session::get('adminId')){
    $stories = Story::find($id);
     
    
    return view('admin.stories.edit', compact('stories'));
}else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }  
}

    
public function update(Request $request, $id)
{
    if(Session::get('adminId')){
    $data = Story::find($id);
    $originalValues = $data->toArray(); 

    $data->heading = $request->get('heading');
    $data->date = $request->get('date');
    $data->description = $request->get('description');

    // Validate image format
    if ($request->hasfile('image')) {
        $file = $request->file('image');
        $allowedFormats = ['jpg', 'jpeg', 'png', 'avif'];
        $extension = strtolower($file->getClientOriginalExtension());
        
        if (!in_array($extension, $allowedFormats)) {
            return redirect()->back()->with('error', 'Invalid image format. Please upload a jpg, jpeg, png, or avif image.');
        }

        $filename = time() . '.' . $extension;
        $file->move('uploads/images/', $filename);
        $data->image = $filename;
    }

    // Add validation to check if the date is today or a future date
    $today = now()->format('j F Y');
    if ($data->date < $today) {
        return redirect()->back()->with('error', 'Date must be today or a future date.');
    }

    $updatedFields = array_diff_assoc($data->toArray(), $originalValues);

    if (empty($updatedFields)) {
        return redirect()->route('stories.index')->with('Message', 'No changes were made.');
    }

    if ($data->save()) {
        return redirect()->route('stories.index')->with('Message', 'Story updated successfully');
    }
 }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }  }

    public function destroy($id)
    {  if(Session::get('adminId')){
        $data = Story::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('Message', 'Stories deleted successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
     }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }  }
}
