<?php

namespace App\Http\Controllers;
use App\Models\Skill;
use App\Models\Category;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class MidAuthController extends Controller
{
   
        public function indexMain(Request $request)
    {
        
            $jobstop = DB::table('jobs')->orderBy('id','DESC')->paginate(2);
                     if(Session::get('user_id')){
          foreach($jobstop as $temp){
            $temp->apply_job_status=0;
              $wish = DB::table('apply_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_job_status = 1;
              }
          }
                foreach($jobstop as $new){
                          $new->saved_job_status=0;
              $save = DB::table('saved_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$new->id)->count();
               
              if($save > 0){
                  $new->saved_job_status = 1;
              }
              
          }
}
// 
            $jobs = DB::table('jobs')->orderBy('id','DESC')->paginate(9);
            if(Session::get('user_id')){
          foreach($jobs as $temp){
            $temp->apply_job_status=0;
              $wish = DB::table('apply_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_job_status = 1;
              }
          }
           foreach($jobs as $new){
                          $new->saved_job_status=0;
              $save = DB::table('saved_jobs')->where('user_id',Session::get('user_id'))->where('job_id',$new->id)->count();
               
              if($save > 0){
                  $new->saved_job_status = 1;
              }
              
          }
}
            // 
              $jobsintern = DB::table('internships')->orderBy('id','DESC')->paginate(9);
               if(Session::get('user_id')){
          foreach($jobsintern as $temp){
            $temp->apply_intern_status=0;
            
              $wish = DB::table('apply_internships')->where('user_id',Session::get('user_id'))->where('internship_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_intern_status = 1;
              }
          }
           foreach($jobsintern as $new){
                          $new->saved_intern_status=0;
              $save = DB::table('saved_internships')->where('user_id',Session::get('user_id'))->where('internship_id',$new->id)->count();
               
              if($save > 0){
                  $new->saved_intern_status = 1;
              }
              
          }
          
}
  
  return view('Front-end.index',compact('jobs','jobsintern','jobstop'));
    } 
   
   
    
    public function showupdrade(Request $request)
    {
       
  return view('Front-end.upgrade_now');
    }
    
    
       public function showverification(Request $request)
       
    {
             if(Session()->get('user_id')){
  return view('Front-end.OTP_verification');
    }
     
    else{
      return redirect('/')->with('error',"Login First");
    }}
    
    
          public function showComplete(Request $request)
    {
             if(Session()->get('user_id')){
  return view('Front-end.complete_profile');
    } else{
      return redirect('/')->with('error',"Login First");
    }}
    
    
             public function showcandidate(Request $request)
    {
          if(Session()->get('user_id')){
  return view('Front-end.candidate_profile');
    } else{
      return redirect('/')->with('error',"Login First");
    }}
    

   public function show($id)
{


    $shareUrl = URL::route('blog.show', ['id' => $id]);

    return view('blog.show', compact('shareUrl'));
}
 
  
}
