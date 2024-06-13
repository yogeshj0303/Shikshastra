<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reject;
use Illuminate\Support\Facades\DB;
use App\Models\EmployerNotification;
use Carbon\Carbon;


class NotificationApiController extends Controller

{

public function notify(Request $request)
{
    
    $notifications = EmployerNotification::orderBy('id', 'DESC')
    ->where('notification_to', $request->user_id)
    ->select('user_id', 'type', 'message', 'date','created_at')
    ->get()
    ->map(function ($notification) {
        // Format the date as 'd M Y' (e.g., '1 Aug 2023')
        $notification->date = \Carbon\Carbon::parse($notification->date)->format('j M Y');
              $time = \Carbon\Carbon::parse($notification->created_at)->format('g:i A');
        $notification->time= $time;
        return $notification;
    });
    $notifi_count = EmployerNotification::orderBy('id', 'DESC')->where('notification_to',$request->user_id)->count();
      if ($notifi_count > 0) {

       return response([
        'error' => false,
        'data' => $notifications,
        'Notiiication Count' => $notifi_count,
        'message' => "All notificaation retrieved successfully",
       
         ]);

}else{
      return response([
       
         'error' => false,
        'data' => $notifications,
        'message' => "You don't have any notification",
       
    ]);
}
}
public function store(Request $request)
{
    if ($request->user_id) {
        $data = [
            'user_id' => $request->view_user_id,
            'notification_to' => $request->user_id,
            'type' => "Someone viewed your profile",
            'date' => Carbon::now()->format("Y-m-d"),
            'message' => "viewed your profile",
        ];

        EmployerNotification::updateOrCreate(
            ['user_id' => $request->view_user_id, 'notification_to' => $request->user_id],
            $data
        );

        return redirect()->route('show_candidate', [
    'user_id' => $request->user_id,
    'job_id' => $request->job_id,
]);
    }



}

public function strReject(Request $request)
{
    if ($request->user_id) {
     $newjob=DB::table('jobs')->where('id',$request->job_id)->first();
        $data = [
            'user_id' => $request->view_user_id,
            'notification_to' => $request->user_id,
            'job_id' => $request->job_id,
            'type' => "Reject your profile",
            'date' => Carbon::now()->format("Y-m-d"),
            'message' => "We regret to inform you that your application has not been selected for $newjob->job_title at this time. We appreciate your interest and wish you the best in your job search."
        ];
         $data1 = [
            'reject_by' => $request->view_user_id,
            'user_id' => $request->user_id,
            'job_id' => $request->job_id,
               ];
      $existingreject = Reject::where('reject_by', $request->view_user_id)
      
            ->where('user_id', $request->user_id)
            ->first();

            if ($existingreject) {
            // Update the existing notification
            $existingreject->update($data);
        } else {
            // Create a new notification
            Reject::create($data1);
        }
        // Check if a notification with the same criteria exists
        $existingNotification = EmployerNotification::where('notification_to', $request->user_id)
            ->where('type', 'Reject your profile')
            ->where('user_id', $request->view_user_id)
            ->first();

        if ($existingNotification) {
            // Update the existing notification
            $existingNotification->update($data);
        } else {
            // Create a new notification
            EmployerNotification::create($data);
        }
             $reject = DB::table('apply_jobs')->where('user_id', $request->user_id)->where('job_id',$request->job_id)
             ->Update([
                'status'=> 3 ]);
      
       

        return redirect()->back()->with('success', 'Reject application successfully !!');
    }
}

}
