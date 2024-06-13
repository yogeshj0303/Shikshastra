<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerNotification;
// Import Preference model
use Illuminate\Support\Facades\DB; // Import DB class

class NotificationController extends Controller
{
    
 

    public function showNotificationNew(Request $request)
    {
        try {
            // Retrieve all notifications ordered by id in descending order
            $user=DB::table('admins')->where('id',$request->user_id)->where('is_admin',2)->first();
            $user1=DB::table('users')->where('id',$request->user_id)->where('is_admin',3)->first();
           
          
            if($user){
                   
                 $noti_jobs = EmployerNotification::where('is_admin',3)->where('job_id','!=',0)->get();
                  $noti_interns = EmployerNotification::where('is_admin',3)->where('intern_id','!=',0)->get();
             
         
               if($noti_jobs ){
                   foreach($noti_jobs as $new){
                            
                  $new_jobs=DB::table('jobs')->where('id',$new->job_id)->where('post_user_id',$request->user_id)->first();
                if($new_jobs){
                 
                        $notifications = EmployerNotification::orderBy('id', 'DESC')->where('is_admin',3)->where('job_id',$new_jobs->id)->get();

                  } }
                   
                   
               }
          if($noti_interns){
                   
                    $noti_interns = EmployerNotification::where('is_admin',3)->where('intern_id','!=',0)->get();
                   
                   foreach($noti_interns as $new){
                        
                  $new_interns=DB::table('internships')->where('id',$new->intern_id)->where('post_user_id',$request->user_id)->first();
                if($new_interns){
                 
                        $notifications = EmployerNotification::orderBy('id', 'DESC')->where('is_admin',3)->where('intern_id',$new_interns->id)->get();

                  } }
                   
                   
               }
                
                
               }
                 
                     
           elseif($user1){
          $notifications = EmployerNotification::orderBy('id', 'DESC')->where('is_admin',2)->get();

          }
          else{
             return response()->json(['error' => true, 'data' => 'User not found']); 
          }
          
            if ($notifications->isEmpty()) {
                return response()->json(['error' => true, 'data' => 'Notifications not available']);
            }

          
            
            foreach ($notifications as $notification) {
                if ($notification->type == 'Job Posted') {
                    $notification->message = 'Job Posted: ' . $notification->message;
                } elseif ($notification->type == 'Internship Posted') {
                    $notification->message = 'Internship Posted: ' . $notification->message;
                }
            }
            

            return response()->json(['error' => false, 'data' => $notifications]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }
   
   
   
 
}