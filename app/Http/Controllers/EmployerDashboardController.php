<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Company;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Session;

class EmployerDashboardController extends Controller
{
    public function Dashboard()
    {
          $new = Session::get('Employer_id');
         $user = DB::table('admins')->where('id', $new)->first();
         if($user){  
        return view('employer.dashboard');
         }
         else{
             return redirect('/Employer_login')->with('error',"Login First");
         }
    }
    
     public function showDashboard(Request $request)
    {
       $new = Session::get('Employer_id');
         $user = DB::table('admins')->where('id', $new)->first();
         if($user){
        return view('Front-end.Employer_dashboard');
         }
         else{
             return redirect('/Employer_login')->with('error',"Login First");
         }
    }
   
   
}
