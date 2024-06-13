<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ApplyInternship;
use App\Models\Internship;
use App\Models\SavedInternship;
use Illuminate\Support\Facades\DB;
use App\Models\EmployerNotification;
use Carbon\Carbon;
use Session;
 
class ApplyInternshipController extends Controller
{
    
public function frontEmployerInternshipStatus(Request $request)
{
  
    // Update the status in the database
    $updated = DB::table('apply_internships')
                ->where('id', $request->application_id)
                ->update(['status' => $request->status]);

    // Check if the update was successful
    if ($updated) {
        // Fetch the updated data
        $updatedData = DB::table('apply_internships')->where('id', $request->application_id)->first();

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
        'internship_id' => 'required',
       
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


    $existingApplication = ApplyInternship::where([
        'user_id' => $request->user_id,
        'internship_id' => $request->internship_id,
    ])->first();

    if ($existingApplication) {
        return response()->json([
            'error' => true,
            'message' => 'Internship already applied for by this user.',
            
        ]);
    }

    $jobApplication = ApplyInternship::create([
        'user_id' => $request->user_id,
        'internship_id' => $request->internship_id,
        
    ]);
    if($jobApplication){
  $new_internship=DB::table('internships')->where('id',$request->internship_id)->first();
                 $eve = User::where('id',$request->user_id)->first();
                 $eve->job_apply_noti = 1;
                 if($eve->update()){
                       $adminNoti = new EmployerNotification;
                       $adminNoti->user_id = $request->user_id;
                        $adminNoti->notification_to = $new_internship->post_user_id;
                      $adminNoti->intern_id = $request->internship_id;
                       $adminNoti->type = "Internship Applied";
                       $adminNoti->date = Carbon::now()->format("Y-m-d");
                       $adminNoti->message = " $eve->fname $eve->lname Internship Applied for $new_internship->internship_title ";
                       $adminNoti->save();
                         }}

    // Assuming you have relationships set up, you can retrieve user and job details
    $user = User::find($request->user_id);
    $job = Internship::find($request->internship_id);

    return response()->json([
        'error' => false,
        'message' => 'Internship applied successfully.',
        'user_details' => $user,
        'internship_details' => $job,
        
    ]);
        }else
        {
            return response()->json([
        'error' => true,
        'message' => 'Your profile is not yet complete. Please ensure at least 80% of your profile is filled out before applying',
       
        
    ]);
        }
}

public function saveInternship(Request $request)
{
    {
        if ($request->user_id != null) {
            
            if ($request->internship_id != null) {

                $wishList = SavedInternship::where('user_id', $request->user_id)
                    ->where('internship_id' , $request->internship_id)
                    ->first();

                if ($wishList) {
                    return  response()->json(['error' => true, 'message' => 'Internship Already Saved']);
                } else {
                    $product = Internship::where('id', $request->internship_id)->first();
                    if($product ==null){
                        return  response()->json(['error' => true, 'message' => 'Internship not found']);
                    }else{
                    $wishList = new SavedInternship();
                    $wishList->user_id = $request->user_id;
                    $wishList->internship_id = $request->internship_id;

                    if ($wishList->save()) {
                        $wishLists = SavedInternship::where('user_id', $request->user_id)->get();
                        foreach ($wishLists as $wishList) {
                            $product = Internship::where('id', $wishList->internship_id)->first();

                        }
                        return  response()->json(['error' => false, 'data' => $wishList, 'message' => 'Internship added successfully']);
                    } else {
                        return  response()->json(['error' => true, 'message' => 'Internship not added ']);
                    }
                    }
                }
            } else {
                return  response()->json(['error' => true, 'message' => 'Internship not found']);
            }
        } else {
            return  response()->json(['error' => true, 'message' => 'User id not found']);
        }
    }

}

public function saveInternshipfront(Request $request)
{
    {
        if ($request->user_id != null) {
            // 
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

        if ($trueConditionCount >= 5) {
            
            // 
            if ($request->internship_id != null) {

                $wishList = SavedInternship::where('user_id', $request->user_id)
                    ->where('internship_id' , $request->internship_id)
                    ->first();

                if ($wishList) {
                    $wishList->delete();
                    return  response()->json(['error' => false, 'message' => 'Internship Unsaved Succesfully']);
                } else {
                    $product = Internship::where('id', $request->internship_id)->first();
                    if($product ==null){
                        return  response()->json(['error' => true, 'message' => 'Internship not found']);
                    }else{
                    $wishList = new SavedInternship();
                    $wishList->user_id = $request->user_id;
                    $wishList->internship_id = $request->internship_id;

                    if ($wishList->save()) {
                        $wishLists = SavedInternship::where('user_id', $request->user_id)->get();
                        foreach ($wishLists as $wishList) {
                            $product = Internship::where('id', $wishList->internship_id)->first();

                        }
                        return  response()->json(['error' => false, 'data' => $wishList, 'message' => 'Internship added successfully']);
                    } else {
                        return  response()->json(['error' => true, 'message' => 'Internship not added ']);
                    }
                    }
                }
            } else {
                return  response()->json(['error' => true, 'message' => 'Internship not found']);
            }
        } else {
            return  response()->json(['error' => true, 'message' => 'Your profile is not yet complete. Please ensure at least 80% of your profile is filled out before applying']);
        }
        } else {
            return  response()->json(['error' => true, 'message' => 'User id not found']);
        }
    }

}
public function unsaveInternship(Request $request)
{
    if ($request->user_id != null) {
        if ($request->internship_id != null) {
            $savedInternship = SavedInternship::where('user_id', $request->user_id)
                ->where('internship_id', $request->internship_id)
                ->first();

            if ($savedInternship) {
                if ($savedInternship->delete()) {
                    return response()->json(['error' => false, 'message' => 'Internship removed from saved list']);
                } else {
                    return response()->json(['error' => true, 'message' => 'Failed to remove internship from saved list']);
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Internship not found in saved list']);
            }
        } else {
            return response()->json(['error' => true, 'message' => 'Internship id not found']);
        }
    } else {
        return response()->json(['error' => true, 'message' => 'User id not found']);
    }
}


public function getSavedInternship(Request $request)
{
    if ($request->user_id != null) {
        $user_id = $request->user_id;

        $jobs = Internship::with('admin')
            ->whereHas('savedInternships', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();

        foreach ($jobs as $job) {
            $job->is_saved = true; // All jobs in this query are saved by the user
            $job->is_applied = $job->applyInternships()->where('user_id', $user_id)->exists();
        }

        return response()->json(['error' => false, 'data' => $jobs, 'message' => 'Saved internships retrieved successfully']);
    } else {
        return response()->json(['error' => true, 'message' => 'User id not found']);
    }
}


public function frontSavedInternship(Request $request)
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

        $jobs = Internship::with('admin')
            ->whereHas('savedInternships', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();

        foreach($jobs as $temp){
            $temp->apply_intern_status=0;
              $wish = DB::table('apply_internships')->where('user_id',Session::get('user_id'))->where('internship_id',$temp->id)->count();
               
              if($wish > 0){
                  $temp->apply_intern_status = 1;
              }
          }
           foreach($jobs as $new){
                          $new->saved_intern_status=0;
              $save = DB::table('saved_internships')->where('user_id',Session::get('user_id'))->where('internship_id',$new->id)->count();
               
              if($save > 0){
                  $new->saved_intern_status = 1;
              }
              
          }
        return view('Front-end.saved_internship',compact('jobs'));
        } else {
        return redirect()->back()->with('Error',"Your profile is not yet complete. Please ensure at least 80% of your profile is filled out before applying");
    }
     
    } else {
        return redirect('/')->with('Error',"login first");
    }
}

public function getApplyInternships(Request $request)
{
    if ($request->user_id != null) {
        $user_id = $request->user_id;
        $wishLists = ApplyInternship::where('user_id', $user_id)->get();

        $internshipData = [];

        foreach ($wishLists as $wishList) {
            $internship = Internship::with('admin') // Eager load the admin relationship
                ->where('id', $wishList->internship_id)
                ->first();

            if ($internship != null) {
                // Check if the internship is applied by the user
                $isApplied = ApplyInternship::where('user_id', $user_id)
                    ->where('internship_id', $wishList->internship_id)
                    ->exists();

                // Check if the internship is saved by the user
                $isSaved = SavedInternship::where('user_id', $user_id)
                    ->where('internship_id', $wishList->internship_id)
                    ->exists();

                // Update the status fields directly in the Internship model
                $internship->is_applied = $isApplied;
                $internship->is_saved = $isSaved;

               $internshipData[] = $internship;
            }
        }

        return response()->json(['error' => false, 'data' => $internshipData, 'message' => 'Saved internships retrieved successfully']);
    } else {
        return response()->json(['error' => true, 'message' => 'User id not found']);
    }
}

 public function delApplyinternship(Request $request)
    {
     dd($request);
     if(Session::get('Employer_id')){
   if(!empty($request->apply_id)){
       
   $newdelete=ApplyInternship::find($request->apply_id);
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

 public function delinternship(Request $request)
    {
     
     if(Session::get('Employer_id')){
   if(!empty($request->id)){
       
   $newdelete=Internship::find($request->id);
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




}