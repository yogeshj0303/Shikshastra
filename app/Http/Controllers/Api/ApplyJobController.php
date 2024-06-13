<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApplyJob;
use App\Models\Job;
use App\Models\EmployerNotification;
use App\Models\Internship;
use App\Models\SavedJob;
use App\Models\SavedInternship;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\DB; 
class ApplyJobController extends Controller
{
    public function frontEmployerInternshipStatus(Request $request)
{
  
    // Update the status in the database
    $updated = DB::table('apply_jobs')
                ->where('id', $request->application_id)
                ->update(['status' => $request->status]);

    // Check if the update was successful
    if ($updated) {
        // Fetch the updated data
        $updatedData = DB::table('apply_jobs')->where('id', $request->application_id)->first();

        // Return a JSON response with the updated data
        return response()->json([
            'status' => 'success',
            'data' => $updatedData
        ]);
    } else {
        // Return a JSON response indicating failure
        return response()->json([
            'status' => 'failure',
            'message' => 'Unable to update status'
        ]);
    }
}

  public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'job_id' => 'required',
       
    ]);
     $qual_count = DB::table('education')->where('user_id', $request->user_id)->count();
        $ex_count = DB::table('experiences')->where('user_id', $request->user_id)->count();
        $doc_count = DB::table('documents')->where('user_id', $request->user_id)->count();
        $skill_count = DB::table('qualities')->where('user_id', $request->user_id)->count();
        $user = DB::table('users')->where('id', $request->user_id)->first();

        $email_count = 0;
        $phone_verified = 0;

        if ($user->is_everify == 1) {
            $email_count = DB::table('users')->where('is_everify', 1)->count();
        }

        if ($user->is_phone_verified == 1) {
            $phone_verified = DB::table('users')->where('is_phone_verified', 1)->count();
        }

        $trueConditionCount = 0;

        if (!empty($qual_count)) {
            $trueConditionCount++;
        }
        if (!empty($ex_count)) {
            $trueConditionCount++;
        }
        if (!empty($doc_count)) {
            $trueConditionCount++;
        }
        if (!empty($skill_count)) {
            $trueConditionCount++;
        }
        if (!empty($phone_verified)) {
            $trueConditionCount++;
        }
        if (!empty($email_count)) {
            $trueConditionCount++;
        }

        if ($trueConditionCount <= 5) {
            
            $existingApplication = ApplyJob::where([
        'user_id' => $request->user_id,
        'job_id' => $request->job_id,
    ])->first();

    if ($existingApplication) {
        return response()->json([
            'error' => true,
            'message' => 'Job already applied for by this user.',
            
        ]);
    }
    

    $jobApplication = ApplyJob::create([
        'user_id' => $request->user_id,
        'job_id' => $request->job_id,
        
    ]);
    
if($jobApplication){
  
                 $eve = User::where('id',$request->user_id)->first();
                 $eve->job_apply_noti = 1;
                 if($eve->update()){
                       $new_jobs=DB::table('jobs')->where('id',$request->job_id)->first();
                       $adminNoti = new EmployerNotification;
                       $adminNoti->user_id = $request->user_id;
                         $adminNoti->notification_to = $new_jobs->post_user_id;
                      $adminNoti->job_id = $request->job_id;
                       $adminNoti->type = "Job Applied";
                       $adminNoti->date = Carbon::now()->format("Y-m-d");
                       $adminNoti->message = " $eve->fname $eve->lname Job Applied";
                       $adminNoti->save();
                         }}
    // Assuming you have relationships set up, you can retrieve user and job details
    $user = User::find($request->user_id);
    $job = Job::find($request->job_id);

    return response()->json([
        'error' => false,
        'message' => 'Job application successful.',
        'user_details' => $user,
        'job_details' => $job,
        
    ]);
            
}else{
  return response()->json([
        'error' => true,
'message' => 'Your profile is not yet complete. Please ensure at least 80% of your profile is filled out before applying.'

        
    ]);
}

    
}

public function saveJob(Request $request)
{
    {
        if ($request->user_id != null) {
            if ($request->job_id != null) {

                $wishList = SavedJob::where('user_id', $request->user_id)
                    ->where('job_id' , $request->job_id)
                    ->first();

                if ($wishList) {
                    return  response()->json(['error' => true, 'message' => 'Job Already Saved']);
                } else {
                    $product = Job::where('id', $request->job_id)->first();
                    if($product ==null){
                        return  response()->json(['error' => true, 'message' => 'Job not found']);
                    }else{
                    $wishList = new SavedJob();
                    $wishList->user_id = $request->user_id;
                    $wishList->job_id = $request->job_id;

                    if ($wishList->save()) {
                        $wishLists = SavedJob::where('user_id', $request->user_id)->get();
                        foreach ($wishLists as $wishList) {
                            $product = Job::where('id', $wishList->job_id)->first();

                        }
                        return  response()->json(['error' => false, 'data' => $wishList, 'message' => 'Job added successfully']);
                    } else {
                        return  response()->json(['error' => true, 'message' => 'Job not added ']);
                    }
                    }
                }
            } else {
                return  response()->json(['error' => true, 'message' => 'Job not found']);
            }
        } else {
            return  response()->json(['error' => true, 'message' => 'User id not found']);
        }
    }

}

public function unsaveJob(Request $request)
{
    if ($request->user_id != null) {
        if ($request->job_id != null) {
            $savedJob = SavedJob::where('user_id', $request->user_id)
                ->where('job_id', $request->job_id)
                ->first();

            if ($savedJob) {
                $savedJob->delete();
                return response()->json(['error' => false, 'message' => 'Job removed from saved list']);
            } else {
                return response()->json(['error' => true, 'message' => 'Job not found in saved list']);
            }
        } else {
            return response()->json(['error' => true, 'message' => 'Job id not provided']);
        }
    } else {
        return response()->json(['error' => true, 'message' => 'User id not provided']);
    }
}





public function saveJobFront(Request $request)
{
    if ($request->user_id !== null) {$qual_count = DB::table('education')->where('user_id', $request->user_id)->count();
        $ex_count = DB::table('experiences')->where('user_id', $request->user_id)->count();
        $doc_count = DB::table('documents')->where('user_id', $request->user_id)->count();
        $skill_count = DB::table('qualities')->where('user_id', $request->user_id)->count();
        $user = DB::table('users')->where('id', $request->user_id)->first();

        $email_count = 0;
        $phone_verified = 0;

        if ($user->is_everify == 1) {
            $email_count = DB::table('users')->where('is_everify', 1)->count();
        }

        if ($user->is_phone_verified == 1) {
            $phone_verified = DB::table('users')->where('is_phone_verified', 1)->count();
        }

        $trueConditionCount = 0;

        if (!empty($qual_count)) {
            $trueConditionCount++;
        }
        if (!empty($ex_count)) {
            $trueConditionCount++;
        }
        if (!empty($doc_count)) {
            $trueConditionCount++;
        }
        if (!empty($skill_count)) {
            $trueConditionCount++;
        }
        if (!empty($phone_verified)) {
            $trueConditionCount++;
        }
        if (!empty($email_count)) {
            $trueConditionCount++;
        }

        if ($trueConditionCount >= 5) {
            if ($request->job_id !== null) {
              

            $wishList = SavedJob::where('user_id', $request->user_id)
                ->where('job_id', $request->job_id)
                ->first();

            if ($wishList) {
                // Delete the saved job record
                $wishList->delete();

                return response()->json(['error' => false, 'message' => 'Job Unsaved successfully']);
            } else {
                $product = Job::find($request->job_id);

                if ($product == null) {
                    return response()->json(['error' => true, 'message' => 'Job not found']);
                }

                $wishList = new SavedJob();
                $wishList->user_id = $request->user_id;
                $wishList->job_id = $request->job_id;

                if ($wishList->save()) {
                    // Fetch the updated list of saved jobs
                    $wishLists = SavedJob::where('user_id', $request->user_id)->get();

                    return response()->json(['error' => false, 'data' => $wishLists, 'message' => 'Job added successfully']);
                } else {
                    return response()->json(['error' => true, 'message' => 'Job not added']);
                }
            }
        } else {
            return response()->json(['error' => true, 'message' => 'Job id not found']);
        }
           
        } else{
  return response()->json([
        'error' => true,
'message' => 'Your profile is not yet complete. Please ensure at least 80% of your profile is filled out before applying.'

        
    ]);
}
    } else {
        return response()->json(['error' => true, 'message' => 'User id not found']);
    }
}







// public function getSavedJobs(Request $request)
// {
//     if ($request->user_id != null) {
//         $wishLists = SavedJob::where('user_id', $request->user_id)->get();

//         $savedJobs = [];

//         foreach ($wishLists as $wishList) {
//             $product = Job::where('id', $wishList->job_id)->first();
//             if ($product != null) {
//                 $isSaved = true;
//                 $isApplied = false;

//                 // Check if the job is applied by the user
//                 $appliedJob = ApplyJob::where('user_id', $request->user_id)
//                                         ->where('job_id', $wishList->job_id)
//                                         ->first();
//                 if ($appliedJob) {
//                     $isApplied = true;
//                 }

                
//                 $savedJob = SavedJob::where('user_id', $request->user_id)
//                                     ->where('job_id', $wishList->job_id)
//                                     ->first();
//                 $isJobSaved = ($savedJob !== null);

//                 $jobData = [
//                     'job' => $product,
//                     'is_saved' => $isSaved,
//                     'is_applied' => $isApplied,
                     
//                 ];

//                 $savedJobs[] = $jobData;
//             }
//         }

//         return response()->json(['error' => false, 'data' => $savedJobs, 'message' => 'Saved jobs retrieved successfully']);
//     } else {
//         return response()->json(['error' => true, 'message' => 'User id not found']);
//     }
// }

public function getSavedJobs(Request $request)
{
    if ($request->user_id != null) {
        $user_id = $request->user_id;

        $jobs = Job::with('admin')
            ->whereHas('savedJobs', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();

        foreach ($jobs as $job) {
            $job->is_saved = true; // All jobs in this query are saved by the user
            $job->is_applied = $job->applyJobs()->where('user_id', $user_id)->exists();
        }

        return response()->json(['error' => false, 'data' => $jobs, 'message' => 'Saved jobs retrieved successfully']);
    } else {
        return response()->json(['error' => true, 'message' => 'User id not found']);
    }
}


public function frontSavedJobs(Request $request)
{
    if (Session::has('user_id')) {
  $qual_count = DB::table('education')->where('user_id', Session::get('user_id'))->count();
        $ex_count = DB::table('experiences')->where('user_id', Session::get('user_id'))->count();
        $doc_count = DB::table('documents')->where('user_id', Session::get('user_id'))->count();
        $skill_count = DB::table('qualities')->where('user_id', Session::get('user_id'))->count();
        $user = DB::table('users')->where('id', Session::get('user_id'))->first();

        $email_count = 0;
        $phone_verified = 0;

        if ($user->is_everify == 1) {
            $email_count = DB::table('users')->where('is_everify', 1)->count();
        }

        if ($user->is_phone_verified == 1) {
            $phone_verified = DB::table('users')->where('is_phone_verified', 1)->count();
        }

        $trueConditionCount = 0;

        if (!empty($qual_count)) {
            $trueConditionCount++;
        }
        if (!empty($ex_count)) {
            $trueConditionCount++;
        }
        if (!empty($doc_count)) {
            $trueConditionCount++;
        }
        if (!empty($skill_count)) {
            $trueConditionCount++;
        }
        if (!empty($phone_verified)) {
            $trueConditionCount++;
        }
        if (!empty($email_count)) {
            $trueConditionCount++;
        }

        if ($trueConditionCount >= 5) {
        $user_id = Session::get('user_id');

        $jobs = Job::with('admin')
            ->whereHas('savedJobs', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();

     
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
        return view('Front-end.saved_jobs',compact('jobs'));
        }
    else {
         return redirect()->back()->with('Error',"Your profile is not yet complete. Please ensure at least 80% of your profile is filled out before applying");
    }
         }
    else {
         return redirect('/')->with('Error',"login first");
    }
}








public function getApplyJobs(Request $request)
{
    if ($request->user_id != null) {
        $user_id = $request->user_id;
        $wishLists = ApplyJob::where('user_id', $user_id)->get();

        $internshipData = [];

        foreach ($wishLists as $wishList) {
            $internship = Job::with('admin') // Eager load the admin relationship
                ->where('id', $wishList->job_id)
                ->first();

            if ($internship != null) {
                // Check if the internship is applied by the user
                $isApplied = ApplyJob::where('user_id', $user_id)
                    ->where('job_id', $wishList->job_id)
                    ->exists();

                // Check if the internship is saved by the user
                $isSaved = SavedJob::where('user_id', $user_id)
                    ->where('job_id', $wishList->job_id)
                    ->exists();

                // Update the status fields directly in the Internship model
                $internship->is_applied = $isApplied;
                $internship->is_saved = $isSaved;

               $internshipData[] = $internship;
            }
        }

        return response()->json(['error' => false, 'data' => $internshipData, 'message' => 'Saved jobs retrieved successfully']);
    } else {
        return response()->json(['error' => true, 'message' => 'User id not found']);
    }
}

public function changeStatus(Request $request)
{
    if(!empty($request->job_id) && !empty($request->user_id)){
        // $newuser=DB::table('users')->where('id',$request->user_id)->first();
        // $newjob=DB::table('jobs')->where('id',$request->job_id)->first();
        
        // if($newuser){
        //     if($newjob){
                
          
        $new=DB::table('apply_jobs')->where('job_id',$request->job_id)->where('user_id',$request->user_id)->update(
            [
                'status'=>$request->status]);
                
        // }else{
        //      return response([
        //     'error'=>true,
        //     'message'=>"job not found"
        //     ]);
        // }
            
        // }
        // else{
        //      return response([
        //     'error'=>true,
        //     'message'=>"user not found"
        //     ]);
        // }
        return response([
            'error'=>false,
            'message'=>"Status Changed"
            ]); 
    }
    else{
        return response([
            'error'=>true,
            'message'=>"user and jobs both are required"
            ]);
    }
}
public function delApplyjob(Request $request)
    {
     
     if(Session::get('Employer_id')){
   if(!empty($request->apply_id)){
       
   $newdelete=ApplyJob::find($request->apply_id);
  if($newdelete){
     $newdelete->delete();
 

      return redirect()->route('posted.jobs.index')->with('success',"data deleted successfully!!"); }
   
  else{
        return redirect()->route('posted.jobs.index')->with('error',"Not found!!");     
   }
   }
   else{
       return redirect()->route('posted.jobs.index')->with('error',"Not found!!");  
   }
      
    }
    else{
        return redirect('Employer_login')->with('error','Login first');
    
    }
    }
    public function deljob(Request $request)
    {
     
     if(Session::get('Employer_id')){
   if(!empty($request->id)){
       
   $newdelete=Job::find($request->id);
  if($newdelete){
     $newdelete->delete();
 

      return redirect()->route('posted.jobs.index')->with('success',"data deleted successfully!!"); }
   
  else{
        return redirect()->route('posted.jobs.index')->with('error',"Not found!!");     
   }
   }
   else{
       return redirect()->route('posted.jobs.index')->with('error',"Not found!!");  
   }
      
    }
    else{
        return redirect('Employer_login')->with('error','Login first');
    
    }
    }
    
    
    public function jobprefrenceDel(Request $request)
    {
     
   
   
       
   $new=User::find($request->user_id);
   
  if($new){
     $new->fname = $new->fname;
        $new->lname = $new->lname;
        $new->email = $new->email;
        $new->about_us =  $new->about_us;
        $new->phone_number = $new->phone_number;
        $new->password =   $new->password ;
        $new->prefrence ='';
        $new->save();
        return response([
            'msg'=>'success']);

       }
   
  else{
           
   }

      
 
    }
   
}