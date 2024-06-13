<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\SavedJob;
use App\Models\ApplyJob;
use App\Models\Internship;
use App\Models\Location;


class LocationController extends Controller

{

public function showLocation(Request $request)
{
    $allLocations = Location::all();

    return response([
        'error' => false,
        'data' => $allLocations,
        'message' => "All locations retrieved successfully",
       
    ]);
}


public function getMatchingJobs(Request $request)
{
    $location = $request->input('location');
    $user_id = $request->input('user_id'); 

    $jobs = Job::where('location', $location)
                ->with('admin')
                ->get();

    
    foreach ($jobs as $job) {
        $is_saved = SavedJob::where('user_id', $user_id)
            ->where('job_id', $job->id)
            ->exists();

        $is_applied = ApplyJob::where('user_id', $user_id)
            ->where('job_id', $job->id)
            ->exists();

        $job->is_saved = $is_saved;
        $job->is_applied = $is_applied;
    }

    return response([
        'error' => false,
        'data' => $jobs,
        'message' => "All Jobs retrieved successfully",
       
    ]);
}





}
