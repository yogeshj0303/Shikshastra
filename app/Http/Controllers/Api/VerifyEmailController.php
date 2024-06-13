<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
class VerifyEmailController extends Controller
{  
       
public function EmailVerification(Request $request, $id)
{
    $result = DB::table('users')->where('rand_id', $id)->get();
    
    if (isset($result[0])) {
        // Update the user's email verification status
        $result = DB::table('users')
            ->where(['id' => $result[0]->id])
            ->update(['is_everify' => 1, 'rand_id' => '']);
        
        return response()->json(['error' => false, 'data' => 'Your email id verified successfully']);
    } else {
        return response()->json(['error' => true, 'data' => 'Something went wrong']);
    }
}

       
        public function SendVerificationMail(Request $request)
    {
       
         if($request->user_id){
        $data = $request->user_id;
        $client = User::where('id',$data)->first();
        
         $rand_id = rand(111111111,999999999);
         $client->rand_id=$rand_id;
         
         $client->update();
       
          $data =['name'=>$client->fname,'rand_id'=>"$rand_id"];
            $user['to'] = $client->email;
          
           
            
            Mail::send('admin.email_verification',$data,function($message)use
            ($user){
                 $message->to($user['to']);
                $message->subject('Email Id Verification');
            });

              return response()->json(['error' => false, 'data' => 'Email Send. Please check your email for verification']);
           
       } else{
         return response()->json(['error' => true, 'data' => 'Login First !!!']);
       }
         
       }
 
 
}
