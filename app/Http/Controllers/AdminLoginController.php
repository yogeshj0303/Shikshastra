<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use App\Models\Admin;

use Illuminate\Http\Request;

use App\Rules\MatchOldPassword;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;

use Cookie;

class AdminLoginController extends Controller

{

    //

    public function adlogin()
    {
        return view('admin.admin-login');
    }

    public function admlogin(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']);
        
        $result = DB::table('admins')
            ->where(['email' => $request->email])
            ->get();
          
        if (isset($result[0])) {
            $status = $result[0]->status;
          
            if (Hash::check($request->password, $result[0]->password)) {

           if( $request->has('remember_me')){
            Cookie::queue('useremail',$request->email,1440);
             Cookie::queue('password',$request->password,1440);
        }
        $request->session()->put('adminLogin', true);
        $request->session()->put('adminId', $result[0]->id);
        $request->session()->put('adminName', $result[0]->username);
        $request->session()->put('adminEmail', $result[0]->email);
        $request->session()->put('adminRole', $result[0]->role_id);
            $request->session()->put('isAdmin', $result[0]->is_admin);
                return redirect('dashboard')->with('Success',"login Successfully Done !!!");
            } else {



                $msg = "Please enter valid Email or password";

                return redirect('adminlogin')->with('Message', $msg)->with('error',"Invalid Entry !! ");
            }
        } else {



            $msg = "Please enter valid email or password";

            return redirect('adminlogin')->with('Error', $msg)->with('error',"Invalid Entry!! ");
        }
    }
    
      public function logout(Request $request)
    {
        $request->session()->flush(); 
        return redirect('admin-login')->with('success','You have logged out');;

    }


 public function changePassword(){
        return view('admin.changepassword');
    }
  
public function changPasswordStore(Request $request)
{
    $admin = Admin::where('id',session::get('adminId'))->first(); // Get the authenticated admin user

    $validator = Validator::make($request->all(), [
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    if (Hash::check($request->current_password, $admin->password)) {
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    } else {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect']);
    }
}
}
