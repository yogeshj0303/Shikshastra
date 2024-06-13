<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class ApiController extends Controller
{
    public function register(Request $request){

        $users = new User();
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=Hash::make($request->password);
        $users->save();
        return response()->json([
            'message'=>'Registration successfull',
            'data'=>$users


        ]);

    }
    
     public function login(Request $request)
    {
  if ($request->email !=null ) {
        // $user=User::where('email',$request->email)->first();
        // $id=User::where('id',$request->id)->first();
        $email=User::where('email',$request->email)->first();
        if ($email) {
            if ( !Hash::check($request->input('password'), $email->password)) {
                return response()->json(['status' => false, 'data' => "Password not matched!"]);
            }
            else{
                return response()->json(['status' => true, 'data' => $email]);

            }


        }
         else {
            return response()->json(['status' => false, 'data' => 'User not found!']);
        }
    } else {
        return response()->json(['status' => false, 'data' => 'Null data pass!']);
    }
}
}
