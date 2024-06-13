<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Experience;


class ExperienceApiController extends Controller

{

    public function experienceNew(Request $request)
    {
        $user = User::find($request->user_id);
    
        if (!$user) {
            return response([
                'message' => "User not found",
                'error' => true
            ]);
        }
        $experience = new Experience;
        $experience->user_id = $request->user_id;
        $experience->designation = $request->designation;
        $experience->organization = $request->organization;
        $experience->location = $request->location;
        $experience->start_date = $request->start_date;
        
        
        $experience->end_date = $request->end_date; 
     
    
        $experience->description = $request->description;
        $experience->is_work_home = $request->is_work_home;
        $experience->save();
        
        if ($experience) {
            return response([
                'data' => $experience,
                'message' => "Work Experience added Successfully",
                'error' => false
            ]);
        } else {
            return response([
                'message' => "Something went wrong",
                'error' => true
            ]);
        }
    }










   
public function experience(Request $request)
{
    $user = User::find($request->user_id);
    
    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    $experience = new Experience;
    $experience->user_id = $request->user_id;
    $experience->designation = $request->designation;
    $experience->organization = $request->organization;
    $experience->location = $request->location;
    $experience->start_date = $request->start_date;
    
    
    if ($request->has('is_working') && $request->is_working) {
        $experience->end_date = null;
    } else {
        $experience->end_date = $request->end_date; 
    }

    $experience->description = $request->description;
    $experience->is_work_home = $request->is_work_home;
    $experience->save();
    
    if ($experience) {
        return response([
            'data' => $experience,
            'message' => "Work Experience added Successfully",
            'error' => false
        ]);
    } else {
        return response([
            'message' => "Something went wrong",
            'error' => true
        ]);
    }
}



public function showExperience(Request $request)
{
    $user = User::where('id', $request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    $education = Experience::where('user_id', $request->user_id)->get();

    return response([
        'data' => $education,
        'message' => "Experience retrieved successfully",
        'error' => false
    ]);
}

public function deleteExperience(Request $request)
{
    



    $education = Experience::where('id', $request->experience_id)->first();

    if (!$education) {
        return response([
            'message' => "Experience record not found",
            'error' => true
        ]);
    }

    $education->delete();

    return response([
        'message' => "Experience record deleted successfully",
        'error' => false
    ]);
}


 public function editExperience(Request $request)
 
    {
       
        $user = User::where('id', $request->user_id)->first();

        if (!$user) {
            return response([
                'message' => "User not found",
                'error' => true
            ]);
        }

        $experience = Experience::where('id', $request->experience_id)
            ->where('user_id', $request->user_id)
            ->first();

        if (!$experience) {
            return response([
                'message' => "Experience record not found",
                'error' => true
            ]);
        }

        $experience->update([
            'designation' => $request->designation,
            'organization' => $request->organization,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'is_work_home' => $request->is_work_home,
        ]);

        return response([
            'data' => $experience,
            'message' => "Experience record updated successfully",
            'error' => false
        ]);
    }

}
