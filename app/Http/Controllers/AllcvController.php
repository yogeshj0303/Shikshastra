<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class AllcvController extends Controller
{
   
        public function indexMainCv(Request $request ,$user_id)
    {
      $userid=$user_id;
      $userid=$request->user_id;
      if($userid){
          return view('Front-end.cv'); 
    
      }
      else{
                 return view('/')->with('Error','Login first'); 
      }
    }

    
    
    
    

    
  
}
