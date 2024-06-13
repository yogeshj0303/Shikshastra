<?php

namespace App\Http\Controllers;
use Hash;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
public function showUser(){
        $emp = User::all();
        return response()->json(['unique' => $emp]);
    }

    public function index(){
        if( Session::has('adminId')){
        
        $emp = User::orderBy('id','DESC')->paginate(10);
        return view('admin.user.index',compact('emp'));
        }else{
            return redirect('admin-login')->with('error','Login first');
        }
        
    }

    public function register(Request $request){
        
          $request->validate([
        'fname' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'lname' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'phone_number' => 'required|min:10|max:10|unique:users',
         
        'password' => 'required',
        
    ]);
        $data = new User;
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->email = $request->email;
        $data->about_us = 'I am an enthusiastic, self-motivated, reliable, responsible and hard working person. I am a mature team worker and adaptable to all challenging situations. I am able to work well both in a team environment as well as using own initiative. I am able to work well under pressure and adhere to strict deadlines.';
        $data->phone_number = $request->phone_number;
        $data->password = Hash::make($request->password);
        

        if($data->save()){
            return redirect('/')->with('Message', "You have registered Successfully.");
        }
        else{
            return redirect()->back()->with('error', "Something went wrong.");
        }


    }
    
    
    

   public function logincheck(Request $request)
{
    $data = User::orWhere('phone_number', $request->email)
                 ->orWhere('email', $request->email)
                 ->first();
     
    if ($data) {
        if (Hash::check($request->password, $data->password)) {
            $request->session()->put('userlogin', true);
            $request->session()->put('user_id', $data->id);
            $request->session()->put('user_name', $data->fname);
            $request->session()->put('user_email', $data->email);
             $request->session()->put('sub_status', $data->sub_status);
            return redirect('/')->with('Message', 'You have successfully logged in');
        } else {
            return redirect('/')->with('error', 'Invalid login credentials');
        }
    } else {
        return redirect('/')->with('error', 'Invalid login credentials');
    }
}

  

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
      }

      public function changePassword(){
        return view('admin.changepassword');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('/login')->with('success','Password successfully changed');
    }

   public function destroy($id)
    {
        //
        $data = User::find($id);
       if ($data->delete()){
        return redirect()->back()->with('success', "Employee deleted successfully.");
       }
       else{
        return redirect()->back()->with('error', "Something went wrong.");
       }

    }
    
    
      public function EmailVerification(Request $request, $id)
    {
        $result = DB::table('users')->where('rand_id',$id)->get();
        if(isset($result[0])){
            $result = DB::table('users')->where(['id'=>$result[0]->id])->update(['is_everify'=>1,'rand_id'=>'']);
            return redirect()->back()->with('success','Your email id verified successfully');
        }else{
            return redirect('/')->with('Message','Your email is verified successfully');
        }
       }
       
        public function SendVerificationMail(Request $request)
    {
         if( session()->get('userlogin')){
        // $data =  session()->get('clientid');
        $client = User::where('id',$data)->first();
         $rand_id = rand(111111111,999999999);
         $client->rand_id=$rand_id;
         $client->update();
          $data =['name'=>$client->username,'rand_id'=>"$rand_id"];
            $user['to'] = $client->email;
            Mail::send('admin.email_verification',$data,function($message)use
            ($user){
                $message->to($user['to']);
                $message->subject('Email Id Verification');
            });
            return redirect()->back()->with('success','Email Send. Please check your email for verification'); 
           
           
       } else{
            return redirect()->back()->with('error','Session Expired'); 
       }
         
       }
       
       public function sendotp(Request $request)
    {
        if ($request->phone_number) {
            ///////////////////////////////////
            if ($request->type == 0) {
                $admin = User::where('phone_number', $request->phone_number)->first();
                if ($admin) {
                     $admin->phone_number = $request->phone_number;
                    $admin->update();
                } 
                    $pin = mt_rand(1000, 9999);
                    $whatsapp = new WhatsappController();
                    $data = new Request();
                    $data->phone_number = $request->phone_number;
                    $data->type = 'otp';
                    $data->otp = $pin;
                    $whatsapp->send($data);
                    $this->globalotp = $pin;
                    ///////////////////////////////////
                    return response()->json(['error' => false,  'otp' => $pin]);
            } 
            else {
                $pin = mt_rand(1000, 9999);
                $whatsapp = new WhatsappController();
                $data = new Request();
                $data->phone_number = $request->phone_number;
                $data->type = 'otp';
                $data->otp = $pin;
                $whatsapp->send($data);
                $this->globalotp = $pin;
                ///////////////////////////////////
                return response()->json(['error' => false,  'otp' => $pin]);
            }
        } 
        else {
            return response()->json(['error' => true, 'data' => 0,  'message' => 'Null data pass!']);
        }
        
    }

public function verifyOtp(Request $request)
{
    $user = User::where('phone_number', $request->phone_number)->first();
    $inputOtp = $request->input('otp');

    if ($user && $user->phone_verification_otp == $inputOtp) {
        
        $user->is_phone_verified = true;
        $user->save();

        
        return redirect('/'); 
    } else {
        return response()->json(['error' => true, 'message' => 'Invalid OTP']);
    }
}

 public function deleteUser($id)
    {
        
        
        
        $data = User::find($id);
        $data->delete();
        if($data){
            return redirect()->back()->with('Message', 'User deleted successfully !!');

        }
        else{
            return redirect()->back()->with('Error', 'Something went wrong !!');

        }
    }
    
    
     
  public function edit($id){
             $data = User::find($id);
           return view('admin.user.edit',compact('data'));
       }
       
       
            
  public function update(Request $request,$id ){
           
         
         
              $request->validate([
        'fname' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'lname' => 'required|regex:/^[A-Za-z\s\-]+$/',
        'phone_number' => 'required|min:10|max:10|unique:users,phone_number,'.$id,
        'email'=>'required|email|unique:users,email,'.$id,
         'about_us'=>'required',
        'password' => 'required',
        
    ]);
          $data = User::find($id);
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->email = $request->email;
        $data->about_us = $request->about_us;
        $data->phone_number = $request->phone_number;
        $data->password = Hash::make($request->password);
        

        if($data->save()){
            return redirect()->route('user.index')->with('Message', "User Data Updated  Successfully.");
        }
        else{
            return redirect()->back()->with('error', "Something went wrong.");
        }

       }
       
       
         public function view($id){
             $data = User::find($id);
           return view('admin.user.view',compact('data'));
       }
}

