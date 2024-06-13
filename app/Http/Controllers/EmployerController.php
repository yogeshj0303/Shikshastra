<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Admin;
use App\Models\AddRole;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EmployerController extends Controller
{
    public function index()
    {
                
              $emp = DB::table('admins')
->leftJoin("add_roles", "add_roles.id", "=", "admins.role_id")->where('is_admin',2)
->select('add_roles.*','add_roles.name as role_name','admins.*')
->orderBy('admins.id','DESC')->paginate(10);
        return view('admin.Employer.index',compact('emp'));
    }


 public function create()
    {
         
        $emp=Admin::where('is_admin',2)->get();
      $data=AddRole::all();
        return view('admin.Employer.add',compact('data','emp'));
    }
    

    public function store(Request $request)
{
    
    
     // Validation rules
     $request->validate([
        'username' => 'required|regex:/^[A-Za-z\s\-]+$/|unique:admins',
         'website' => ['required', 'regex:/^www\..+/i', 'unique:admins'],
        'first_name' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'last_name' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'email' => 'required|email|unique:admins',
        'address' => 'required',
        'phone' => 'required|unique:admins',
        'industry' => 'required',
        'role_id' => 'required',
        'employee' => 'required',
        'description' => 'required',
        'password' => 'required|min:8',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // You can adjust the allowed image formats and size
    ]);

    $data = new Admin;

    $data->username = $request->username;
    $data->website = $request->website;
    $data->first_name = $request->first_name;
    $data->last_name = $request->last_name;
    $data->email = $request->email;
    $data->address = $request->address;
    $data->phone = $request->phone;
    $data->industry = $request->industry;
    $data->role_id = $request->role_id;
    $data->employee = $request->employee;
    $data->description = $request->description;
    $data->password = Hash::make($request->password);
    $data->date = Carbon::now()->format("j F Y");
    $data->latitude = $request->latitude;
    $data->longitude = $request->longitude;
dd($request->latitude);
    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $ext = $image->getClientOriginalExtension();
        $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;
        $image->move('uploads/images/', $image_name);
        $data->logo = $image_name;
    }

    if ($data->save()) {
        return redirect('employer')->with('Message', 'Employer Added Successfully.');
    } else {
        return redirect()->back()->with('Message', "Something went wrong.");
    }
}

    
  
    public function destroy($id)
    {
         //
        $data = Admin::find($id);
       if($data->delete()){
            $job=DB::table('jobs')->where('post_user_id',$id)->delete();
            $internship=DB::table('internships')->where('post_user_id',$id)->delete();
        return redirect()->back()->with('Message', "Employer data deleted successfully.");
       }
       else{
        return redirect()->back()->with('Error', "Something went wrong.");
       }

    }
    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/');
    }
    
    
    
   public function edit($id)
{
    $data = Admin::find($id);
    $roles = Addrole::all(); 
    
    return view('admin.Employer.edit', compact('data', 'roles'));
}

    
public function update(Request $request, $id)
{
    
    
    $data = Admin::find($id);
    if($request->password==null)
    {
      $pass  =$data->password;
    }else{
      $pass=Hash::make($request->password);
    }
    $originalValues = $data->toArray(); // Corrected from $row to $data

    $data->role_id = $request->get('role_id');
    $data->username = $request->get('username');
    $data->email = $request->get('email');
    $data->phone = $request->get('phone');
    $data->first_name = $request->get('first_name');
    $data->last_name = $request->get('last_name');
    $data->website = $request->get('website');
    $data->address = $request->get('address');
    $data->industry = $request->get('industry');
    $data->employee = $request->get('employee');
    $data->description = $request->get('description');

    $data->password = $pass;

    if ($request->hasfile('logo')) {
        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('uploads/images/', $filename);
        $data->logo = $filename;
    }

    $updatedFields = array_diff_assoc($data->toArray(), $originalValues);

    if (empty($updatedFields)) {
        return redirect()->route('employer.index')->with('info', 'No changes were made.');
    }

    if ($data->save()) {
        return redirect()->route('employer.index')->with('Message', 'Employer Data Updated Successfully');
   

}
}
}
