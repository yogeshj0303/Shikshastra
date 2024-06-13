<?php

namespace App\Http\Controllers\Api;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WhatsappController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\PasswordReset;
use Cache;
use URL;
use Illuminate\Support\Str;
use Mail;
use Session;
use App\Models\Preference;
use App\Models\Experience;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class EmployeeApiController extends Controller
{
   public function employeeRegister(Request $request) {
    $existingUserByEmail = User::where('email', $request->email)->first();
    $existingUserByPhone = User::where('phone_number', $request->phone_number)->first();

    if ($existingUserByEmail) {
        return response([
            'message' => "Email already exists",
            'error' => true
        ]);
    }

    if ($existingUserByPhone) {
        return response([
            'message' => "Phone number already exists",
            'error' => true
        ]);
    }

    $user = new User;
    $user->about_us ='t
I am an enthusiastic, self-motivated, reliable, responsible and hard working person. I am a mature team worker and adaptable to all challenging situations. I am able to work well both in a team environment as well as using own initiative. I am able to work well under pressure and adhere to strict deadlines.';
    $user->fname = $request->fname;
    $user->lname = $request->lname;
    $user->email = $request->email;
    $user->phone_number = $request->phone_number;
    $user->password = Hash::make($request->password);
    $user->save();

    if ($user) {
        return response([
            'data' => $user,
            'message' => "Registration Success",
            'error' => false
        ]);
    } else {
        return response([
            'message' => "Something went wrong",
            'error' => true
        ]);
    }
}

      public function employeeLogin(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        
        if (empty($request->input('email')) || empty($request->input('password')) ) {
             return response([
            'message' => 'email or password both are required',
            'error' => true,
        ]);
        }else{
        
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->sub_status === '1') {
                // If sub_status is '1', perform left join
                $userData = DB::table('subscriptions')
                    ->leftJoin('users', 'users.id', '=', 'subscriptions.user_id') 
                    ->leftJoin('plans', 'plans.id', '=', 'subscriptions.plan_id')
                    ->select('users.*', 'subscriptions.id as sub_id', 'subscriptions.*', 'plans.*','plans.id as plan_id','users.id as id')
                    ->where('email',$request->email)
                   
                    ->first();
            } else {
                // If sub_status is '0', retrieve data from users table only
                $userData = DB::table('users')
                    ->where('email', $request->email)
                    ->first();
            }

            if ($userData && Hash::check($request->password, $user->password)) {
                return response([
                    'message' => 'Login success',
                    'error' => false,
                    'data' => $userData,
                ]);
            }
        }

        return response([
            'message' => 'Incorrect email or password',
            'error' => true,
        ]);
    } 
  
}
     


public function updateProfile(Request $request) 
{
   
    $user = User::where('id', $request->user_id)->first(); 
    
    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    if ($request->hasFile('cv')) {
        $cvFile = $request->file('cv');

      
        if ($cvFile->getClientOriginalExtension() === 'pdf') {
            $cvFileName = time() . '_' . $cvFile->getClientOriginalName();
            $cvFilePath = public_path('uploads/images');
            $cvFile->move($cvFilePath, $cvFileName);

          
            $user->cv = $cvFileName;
            $user->cv_updated_at = Carbon::now()->format('j F Y ');
        } else {
            return response([
                'message' => "CV must be in PDF format",
                'error' => true
            ]);
        }
    }
    


    $user->save();

    return response([
        'data' => $user,
        'message' => "Profile updated successfully",
        'error' => false
    ]);
}







public function aboutme(Request $request) 
{
    $user = User::where('id', $request->user_id)->first(); 
    
    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }
    
    $user->description = $request->description;
     $user->save();

    return response([
        'data' => $user,
        'message' => "Profile updated successfully",
        'error' => false
    ]);
}


public function image(Request $request) 
{
    $user = User::where('id', $request->user_id)->first(); 
    
    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }
    
    if ($request->hasFile('image')) {
        $imageFile = $request->file('image');

        
        
        $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
        $imageFilePath = public_path('uploads/images');
        $imageFile->move($imageFilePath, $imageFileName);

        $user->image = $imageFileName;
    }
     $user->save();

    return response([
        'data' => $user,
        'message' => "Image added successfully",
        'error' => false
    ]);
}


public function getDescription(Request $request)
{
    $user = User::where('id',$request->user_id)->first(); 

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    return response([
        'description' => $user->description,
        'message' => "User description retrieved successfully",
        'error' => false
    ]);
}



public function updateProfileImage(Request $request)
{
    $user = User::find($request->user_id);

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    if ($request->hasFile('image')) {
        $imageFile = $request->file('image');

        // Add additional validation for image file types if needed
        // For example: if ($imageFile->getClientOriginalExtension() === 'jpg' || $imageFile->getClientOriginalExtension() === 'png') {
        
        $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
        $imageFilePath = public_path('uploads/images');
        $imageFile->move($imageFilePath, $imageFileName);

        $user->image = $imageFileName;
        $user->save();

        return response([
            'data' => $user,
            'message' => "Profile image updated successfully",
            'error' => false
        ]);
    } else {
        return response([
            'message' => "Image file not provided",
            'error' => true
        ]);
    }
}


public function updateProfileNew(Request $request)
    {
  
        $user = User::find($request->user_id);

        if (!$user) {
            return response([
                'message' => "User not found",
                'error' => true
            ]);
        }

        $user->fname = $request->fname;
        
        $user->lname = $request->lname;
        
          $user->location = $request->location;
      $user->prefrence = $request->prefrence;

       if ($request->hasfile('image_profile')) {

    $doc = $request->file('image_profile');

    $ext = $doc->getClientOriginalExtension();

    $doc_name = date('y-m-d') . '-' . rand() . '.' . $ext;

    $doc->move('uploads/images/', $doc_name);

    $user->image = $doc_name;

}

        $user->save();

if ($user) {
    $userId = $request->user_id;
    $userPreference = $request->prefrence; // Correct the field name

    // Use updateOrCreate to either update an existing record or create a new one
    Preference::updateOrCreate(
        ['user_id' => $userId, 'category_id' => $userPreference], // Use $userPreference here
        ['user_id' => $userId, 'category_id' => $userPreference]  // Use $userPreference here
    );



  


            return response([
                'data' => $user,
                'message' => "Profile updated successfully",
                'error' => false
            ]);
        } else {
            return response([
                'message' => "Failed to update profile",
                'error' => true
            ]);
        }
    }





public function showCv(Request $request)
{
    $user = User::where('id',$request->user_id)->first(); 

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    return response([
        'cv' => $user->cv,
        'message' => $user,
        'error' => false
    ]);
}

public function showCvButton(Request $request)
{
    $user = User::where('id',$request->user_id)->first(); 

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    return response([
         'data'=>$user->id,
        'message' => "Show CV Button ",
        'error' => false
    ]);
}



public function editDescription(Request $request)
{
    $user = User::where('id',$request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    $user->description = $request->input('description');
    $user->save();

    return response([
        'data' =>$user,
        'error' => false
    ]);
}


     
     
public function deleteCV(Request $request) 
{
    $user = User::find($request->user_id); 
    
    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    if ($user->cv) {
        $cvFilePath = public_path('uploads/images') . '/' . $user->cv;

        if (file_exists($cvFilePath)) {
            unlink($cvFilePath); // 
            $user->cv = null; 
            $user->save();

            return response([
                'message' => "CV deleted successfully",
                'error' => false
            ]);
        } else {
            return response([
                'message' => "CV file not found",
                'error' => true
            ]);
        }
    } else {
        return response([
            'message' => "No CV found for this user",
            'error' => true
        ]);
    }
}


private $globalotp;

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

        $userId = $request->user_id;
        $otp = $request->otp;

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => true, 'message' => 'User not found']);
        }

        if ($otp == $this->globalotp) {
            // Perform further actions (e.g., update user status)
            $user->is_phone_verified = true;
            $user->update();

            return response()->json(['error' => false, 'message' => 'OTP verification successful']);
        } else {
            return response()->json(['error' => true, 'message' => 'Invalid OTP']);
        }
    }
    
        public function ForgetPassword(Request $request){
        try{
           $user  =  User::where('email',$request->email)->get();
            
            if(count($user)>0){
                $token = Str::random(30);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;
                
                
                $data['url'] = $url;
                $data['email']=$request->email;
                 $data['title']="Reset your password";
                 $data['name']=$user[0]->name;
                  $data['body']="Please Click On Below Link To Reset Your Password";
                  Mail::send('resetpassword.forgetPassword',['data'=>$data],function($message) use ($data){
                      $message->to($data['email'])->subject($data['title']);
                  });
                  $datetime = Carbon::now()->format('Y-m-d H:i:s');
                  PasswordReset::updateOrCreate(
                      ['email'=>$request->email],
                         [
                          'email'=>$request->email,
                          'token' =>$token,
                          'created_at'=>$datetime
                          ]
                      );
                       return response()->json(['error'=>false,'msg'=>'Please Check Your Mail To Reset Your Password']);
            }
            else{
                  return response()->json(['error'=>false,'msg'=>'User Not Found']);
            }
            
        }catch(\Exception $e){
            return response()->json(['error'=>false,'msg'=>$e->getMessage()]);
        }
        
    }
   public function resetPasswordLoad(Request $request)
    {
        $tokendata = $request->token;
        $resetData = DB::table('password_resets')->where('token', $tokendata)->get();

        if (isset($request->token) && count($resetData) > 0) {
            $user = User::where('email', $resetData[0]->email)->first();

            return view('resetpassword.resetpassword', compact('user', 'tokendata', 'resetData'));
        } else {
            return view('resetpassword.error');
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'token' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'User not found');
        }

        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if (!$passwordReset) {
            return back()->with('error', 'Password reset record not found');
        }

        $user->password = bcrypt($request->password);

        if ($user->save()) {
            $passwordReset->delete();
            return redirect('/')->with('Message', 'Password Reset Successfully. Please log in with your new password.');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

            
     
    
    
public function updatePassword(Request $request)
{
    $request->validate([
        'phone_number' => 'required',
        'password' => 'required',
    ]);

    $customer = User::where('phone_number', $request->phone_number)->first();

    if (!$customer) {
        return response()->json(['error' => true, 'message' => 'Customer not found']);
    }

    
    if ($customer) {
        $customer->password = bcrypt($request->password);
        $customer->save();

        $contacts = $customer->phone_number;

        return response()->json(['error' => false, 'message' => 'Password updated successfully', 'contacts' => $contacts]);
    } else {
        return response()->json(['error' => true, 'message' => 'Customer not found']);
    }
}


public function sendotpfront(Request $request)
    {
        if ($request->phone_number) {
             $pin = mt_rand(1000, 9999);
            ///////////////////////////////////
            if ($request->type == 0) {
                $admin = User::where('phone_number', $request->phone_number)->first();
                if ($admin) {
                     $admin->phone_number = $request->phone_number;
                      $admin->globalotp = $pin;
                    $admin->update();

                } 
                
               
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
     public function verifyOtpfront(Request $request)
    {

        $userId = $request->user_id;
        $otp = $request->otp;

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => true, 'message' => 'User not found']);
        }

        if ($otp == $user->globalotp) {
            // Perform further actions (e.g., update user status)
            $user->is_phone_verified = true;
            $user->globalotp = 0;
            $user->update();

            return response()->json(['error' => false, 'message' => 'OTP verification successful']);
        } else {
            return response()->json(['error' => true, 'message' => 'Invalid OTP']);
        }
    }
      public function updateEmployer(Request $request)
{
   

    $data = DB::table('admins')->where('id', $request->employer_id)->update([
    'username'    => $request->username,
    'website'     => $request->website,
    'first_name'  => $request->first_name,
    'last_name'   => $request->last_name,
    'email'       => $request->email,
    'address'     => $request->address,
    'phone'       => $request->phone,
    'industry'    => $request->industry,
    'role_id'     => $request->role_id,
    'employee'    => $request->employee,
    'description' => $request->description,
    'password'    => Hash::make($request->password),
    'date'        => Carbon::now()->format("j F Y"),
]);

if ($request->hasFile('logo')) {
    $image = $request->file('logo');
    $ext = $image->getClientOriginalExtension();
    $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;
    $image->move('uploads/images/', $image_name);

    // Now, update the 'logo' field in the database
    DB::table('admins')->where('id', $request->employer_id)->update([
        'logo' => $image_name,
    ]);
}



    
}


    // $credentials = $request->only('email', 'password');
 
 public function changePasswordStore(Request $request)
{
 
 // Instantiate the custom rule with parameters
$data = new MatchOldPassword($request->employer_id, $request->current_password);

// Use the custom rule in your validation
$request->validate([
    'employer_id' => 'required',
    'current_password' => ['required', $data],
    'new_password' => 'required|min:8',
    'new_confirm_password' => 'required|same:new_password',
]);



    // Check if the user is authenticated
      // Check if the user is authenticated
        if ($request->employer_id) {
            // Retrieve the user from the 'admins' table before the update
            $userBeforeUpdate = DB::table('admins')->where('id', $request->employer_id)->first();

            // Check if the user exists
            if ($userBeforeUpdate) {
                // Update the user's password in the 'admins' table
                DB::table('admins')->where('id', $request->employer_id)->update([
                    'password' => Hash::make($request->new_password)
                ]);

                // Retrieve the updated user data after the update
                $userAfterUpdate = DB::table('admins')->where('id', $request->employer_id)->first();

                // Return a JSON response indicating success with updated data
                return response()->json([
                    'success' => true,
                    'message' => 'Password updated successfully',
                    'data' => $userAfterUpdate,
                ]);
            }
               else {
                // If the user does not exist, return a JSON response with an error
                return response()->json(['success' => false, 'message' => 'related data not found'], 404);
            
}
        }
         
else {
                // If the user does not exist, return a JSON response with an error
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            


        }}
    

}



