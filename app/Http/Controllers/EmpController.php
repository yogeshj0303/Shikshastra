<?php

namespace App\Http\Controllers;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\AddRole;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use URL;
use Mail;

use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Str;
class EmpController extends Controller
{
    public function index()
    {
                
              $emp = DB::table('admins')
->leftJoin("add_roles", "add_roles.id", "=", "admins.role_id")->where('is_admin',3)
->select('add_roles.*','add_roles.name as role_name','admins.*')->
orderBy('admins.id','DESC')->paginate(10);
        return view('admin.Employee.index',compact('emp'));
    }


 public function create()
    {
         
        $emp=Admin::where('is_admin',3)->get();
      $data=AddRole::all();
        return view('admin.Employee.add',compact('data','emp'));
    }
    

   public function store(Request $request){
 
     $request->validate([
     
        'first_name' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'last_name' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'email' => 'required|email|unique:admins',
        'phone' => 'required|unique:admins',
        'role_id' => 'required',
        'password' => 'required|min:8',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // You can adjust the allowed image formats and size
    ]);
    $data = new Admin;
    $data->fill($request->only(['first_name', 'last_name', 'email', 'phone', 'role_id','is_admin']));
    $data->is_admin=3;
    
    $data->password = Hash::make($request->password);
    $data->date = Carbon::now()->format("j F Y");

    // Handle logo upload
    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $image_name = date('y-m-d') . '-' . rand() . '.' . $image->getClientOriginalExtension();
        $image->move('uploads/images/', $image_name);
        $data->logo = $image_name;
    }

    // Save the Admin data
    if ($data->save()) {
        return redirect('employee')->with('Message', 'Employee Added Successfully.');
    } else {
        return redirect()->back()->with('Message', 'Something went wrong.');
    }
}

    
  
    public function destroy($id)
    {
         //
        $data = Admin::find($id);
       if ($data->delete()){
        return redirect()->back()->with('Message', "Employee deleted successfully.");
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
    $roles = AddRole::all(); 

    return view('admin.Employee.edit', compact('data', 'roles'));
}

    
public function update(Request $request, $id)
{
    $data = Admin::find($id);
    $originalValues = $data->toArray(); // Corrected from $row to $data

    $data->role_id = $request->get('role_id');
    
    $data->email = $request->get('email');
    $data->phone = $request->get('phone');
    $data->first_name = $request->get('first_name');
    $data->last_name = $request->get('last_name');

    $data->password = Hash::make($request->password);

    if ($request->hasfile('logo')) {
        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('uploads/images/', $filename);
        $data->logo = $filename;
    }

    $updatedFields = array_diff_assoc($data->toArray(), $originalValues);

    if (empty($updatedFields)) {
        return redirect()->route('employee.index')->with('Message', 'No changes were made.');
    }

    if ($data->save()) {
        return redirect()->route('employee.index')->with('Message', 'Employee  Updated Successfully');
   

}
}

     public function ForgetPassword(Request $request){
        try{
           $user  =  Admin::where('email',$request->email)->get();
            
            if(count($user)>0){
               
                $otp = rand(1000,9999);
                $data['otp'] = $otp;
                
                $data['name'] = $user[0]->first_name;
                $data['email']=$request->email;
                 $data['title']="Reset your password";
                  $data['body']="Reset your password";
                  Mail::send('reset_password.forgetPassword',['data'=>$data],function($message) use ($data){
                      $message->to($data['email'])->subject($data['title']);
                  });
                  $user[0]->otp=$otp;
                $user[0]->save();
                 $email = $request->email;


                       return view('reset_password.otp-verify', compact('email'));
            }
        
            else{
                  return back()->with('error','User Not Found');
            }
            
        }catch(\Exception $e){
            return  redirect()->back()->with('success',$e->getMessage());
        }
        
    }
    public function verifyOtp(Request $request){
      
         $user  =  Admin::where('email',$request->email)->first();
      
                if($user->otp==$request->opt_field){
                        $email = $user->email;
                return view('reset_password.reset-password-frm', compact('email'));

              
            }
            else{
                
                    return redirect()->route('forgot_password')->with('error','Invalid OTP Re-genrate your OTP!!');
            }
    }
    public function newPassword(Request $request){

           $user  =  Admin::where('email',$request->email)->first();

           $user->password=Hash::make($request->new_password);
           $user->otp=0;
           $user->update();
      if($user){
          return redirect()->route('Employer_login')->with('success','Reset Password Successfully !!!');
      }

   else{
      return back()->with('error','operation failed !!');
   
   }
        
        
    }
    
    
      public function ForgetPasswordEmployee(Request $request){
        try{
           $user  =  User::where('email',$request->email)->get();
            
            if(count($user)>0){
               
                $otp = rand(1000,9999);
                $data['otp'] = $otp;
                
                $data['name'] = $user[0]->fname;
                $data['email']=$request->email;
                 $data['title']="Reset your password";
                  $data['body']="Reset your password";
                  Mail::send('reset_password_employee.forgetPassword',['data'=>$data],function($message) use ($data){
                      $message->to($data['email'])->subject($data['title']);
                  });
                  $user[0]->otp=$otp;
                $user[0]->save();
                 $email = $request->email;


                       return view('reset_password_employee.otp-verify', compact('email'));
            }
        
            else{
                  return back()->with('error','User Not Found');
            }
            
        }catch(\Exception $e){
            return  redirect()->back()->with('success',$e->getMessage());
        }
        
    }
    public function verifyOtpEmployee(Request $request){
      
         $user  =  User::where('email',$request->email)->first();
      
                if($user->otp==$request->opt_field){
                        $email = $user->email;
                return view('reset_password_employee.reset-password-frm', compact('email'));

              
            }
            else{
                
                    return redirect()->route('forgot_password_employee')->with('error','Invalid OTP Re-genrate your OTP!!');
            }
    }
    public function newPasswordEmployee(Request $request){

           $user  =  User::where('email',$request->email)->first();

           $user->password=Hash::make($request->new_password);
           $user->otp=0;
           $user->update();
      if($user){
          return redirect()->route('/')->with('success','Reset Password Successfully !!!');
      }

   else{
      return back()->with('error','operation failed !!');
   
   }
        
        
    }
    public function changePasswordStore(Request $request)
{
   
    $request->validate([
        'current_password' => ['required', new MatchOldPassword],
        'new_password' => 'required|min:8',
        'new_confirm_password' => 'required|same:new_password',
    ]);
$new=session::get('Employer_id');
    // Check if the user is authenticated
    if ($new) {
        // Update the user's password in the 'tblLogin' table
        $user = DB::table('admins')->where('id',$new);
        $user->update(['password' => Hash::make($request->new_password)]);

        // Redirect to the appropriate route after successful password change
        return redirect('login')->with('success', 'Password Changed Successfully');
    } else {
        // Handle the case where the user is not authenticated
        return view('error');
    }
}
}
