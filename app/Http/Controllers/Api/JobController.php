<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Admin;
use App\Models\SavedJob;
use App\Models\ApplyJob;
use App\Models\Preference; // Import Preference model
use Illuminate\Support\Facades\DB; // Import DB class

class JobController extends Controller
{
    public function job(Request $request)
    {
        try {
            $user_id = $request->user_id;

            $jobs = Job::with('admin')->get();
                
   $subcategories = Job::where('is_saved', true)
                ->orWhere(function ($query) use ($user_id) {
                    $query->where('is_applied', true)
                        ->whereExists(function ($subQuery) use ($user_id) {
                            $subQuery->select(DB::raw(1))
                                ->from('apply_jobs')
                                ->whereColumn('jobs.id', 'apply_jobs.job_id')
                                ->where('apply_jobs.user_id', $user_id);
                        });
                })
                ->get();
            foreach ($subcategories as $subcategory) {
                $is_saved = SavedJob::where('user_id', $user_id)
                    ->where('job_id', $subcategory->id)
                    ->exists();
                $subcategory->is_saved = $is_saved;
            }

            foreach ($jobs as $job) {
                $is_saved = SavedJob::where('user_id', $user_id)
                    ->where('job_id', $job->id)
                    ->exists();
                $job->is_saved = $is_saved;

                $is_applied = ApplyJob::where('user_id', $user_id)
                    ->where('job_id', $job->id)
                    ->exists();
                $job->is_applied = $is_applied;
            }

            return response([
                'error' => false,
                'data' => $jobs,
                'message' => 'Job data fetched successfully',
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Something went wrong: ' . $e->getMessage(),
                'error' => true
            ]);
        }
    }
public function jobCategory(Request $request)
{
    try {
        $user_id = $request->user_id;

        // Step 1: Retrieve User Preferences
        $userPreferences = Preference::where('user_id', $user_id)->pluck('category_id')->toArray();

        // Step 2: Modify Job Retrieval
        $jobsQuery = Job::with('admin');

        if (!empty($userPreferences)) {
            $jobsQuery->whereIn('category_id', $userPreferences); // Filter jobs by user's selected preferences
        }

        $jobs = $jobsQuery->get();

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
            'message' => 'Job data fetched successfully',
        ]);
    } catch (\Exception $e) {
        return response([
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'error' => true
        ]);
    }
}


public function jobsByCategory(Request $request)
{
    try {
        $user_id = $request->user_id;
        $category_id = $request->category_id;

        // Step 1: Retrieve User Preferences
        // $userPreferences = Preference::where('user_id', $user_id)->pluck('category_id')->toArray();

        // // Step 2: Verify if the requested category is in the user's preferences
        // if (!in_array($category_id, $userPreferences)) {
        //     return response([
        //         'error' => true,
        //         'message' => 'Category is not in user preferences',
        //     ]);
        // }

        // Step 3: Retrieve Jobs by Category
        $jobs = Job::with('admin')
            ->where('category_id', $category_id)
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
            'message' => 'Job data fetched successfully',
        ]);
    } catch (\Exception $e) {
        return response([
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'error' => true
        ]);
    }
}

// near by job
  public function getNearbyJobs(Request $request)
    {
       $userLatitude = $request->input('latitude');
        $userLongitude = $request->input('longitude');
        $radius =  $request->input('radius'); // Radius in miles or kilometers for the job search
        
     
        $data = Job::select('jobs.*')->join('admins', 'jobs.post_user_id', '=', 'admins.id')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
                [$userLatitude, $userLongitude, $userLatitude]
            )
            ->having('distance', '<', $radius)
            ->orderBy('distance', 'asc')
            ->get(); 
         if ($data->isEmpty()) {
            return response()->json([
                'error' => false,
                'message' => 'No nearby jobs available within the specified radius.',
                'data' => []
            ]);
        }
        
        
          foreach ($data as $job) {
        $postUserIdDetails = Admin::find($job->post_user_id);
        $job->admin = $postUserIdDetails;
    }

        return response()->json([
            'error' => false, // Indicate success as 'true'
            'data' => $data
        ]);
    
 
    }
    
    // company list api
     public function company(Request $request)
    {
        $data = DB::table('admins')->where('is_admin',2)->select('username','logo')->get();
        
        
         return response()->json([
            'error' => false, // Indicate success as 'true'
            'data' => $data
        ]);
    }
    
}
