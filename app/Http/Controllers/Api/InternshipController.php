<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WhatsappController;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Preference;
use App\Models\Internship;
use App\Models\SavedInternship;
use App\Models\ApplyInternship;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class InternshipController extends Controller
{
    
public function internship(Request $request)
{
    try {
        $user_id = $request->user_id;

       
        $jobs = Internship::with('admin')->get();

       
   $subcategories = Internship::where('is_saved', true)
    ->orWhere(function ($query) use ($user_id) {
        $query->where('is_applied', true)
            ->whereExists(function ($subQuery) use ($user_id) {
                $subQuery->select(DB::raw(1))
                    ->from('apply_internships')
                    ->whereColumn('internships.id', 'apply_internships.internship_id') // Fix the typo here
                    ->where('apply_internships.user_id', $user_id);
            });
    })
    ->get();


        foreach ($subcategories as $subcategory) {
            
            $is_saved = SavedInternship::where('user_id', $user_id)
                ->where('internship_id', $subcategory->id)
                ->exists();

          
            $subcategory->is_saved = $is_saved;
        }

      
        foreach ($jobs as $job) {
           
            $is_saved = SavedInternship::where('user_id', $user_id)
                ->where('internship_id', $job->id)
                ->exists();

           
            $job->is_saved = $is_saved;

            
            $is_applied = ApplyInternship::where('user_id', $user_id)
                ->where('internship_id', $job->id)
                ->exists();

            
            $job->is_applied = $is_applied;
        }

        return response([
            'error' => false,
            'data' => $jobs,
           
            'message' => 'Internship data fetched successfully',
        ]);
    } catch (\Exception $e) {
        return response([
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'error' => true
        ]);
    }
}

public function internshipCategory(Request $request)
{
    try {
        $user_id = $request->user_id;

        // Step 1: Retrieve User Preferences
        $userPreferences = Preference::where('user_id', $user_id)->pluck('category_id')->toArray();

        // Step 2: Modify Job Retrieval
        $internshipsQuery = Internship::with('admin');

        if (!empty($userPreferences)) {
            $internshipsQuery->whereIn('category_id', $userPreferences); // Filter internships by user's selected preferences
        }

        $internships = $internshipsQuery->get();

        foreach ($internships as $internship) {
            $is_saved = SavedInternship::where('user_id', $user_id)
                ->where('internship_id', $internship->id)
                ->exists();

            $is_applied = ApplyInternship::where('user_id', $user_id)
                ->where('internship_id', $internship->id)
                ->exists();

            $internship->is_saved = $is_saved;
            $internship->is_applied = $is_applied;
        }

        return response([
            'error' => false,
            'data' => $internships,
            'message' => 'Internship data fetched successfully',
        ]);
    } catch (\Exception $e) {
        return response([
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'error' => true
        ]);
    }
}



public function internshipsByCategory(Request $request)
{
    try {
        $user_id = $request->user_id;
        $category_id = $request->category_id;

        // Step 1: Retrieve User Preferences
        // $userPreferences = Preference::where('user_id', $user_id)->pluck('category_id')->toArray();

        // Step 2: Verify if the requested category is in the user's preferences
        // if (!in_array($category_id, $userPreferences)) {
        //     return response([
        //         'error' => true,
        //         'message' => 'Category is not in user preferences',
        //     ]);
        // }

        // Step 3: Retrieve Jobs by Category
        $jobs = Internship::with('admin')
            ->where('category_id', $category_id)
            ->get();

        foreach ($jobs as $job) {
            $is_saved = SavedInternship::where('user_id', $user_id)
                ->where('internship_id', $job->id)
                ->exists();

            $is_applied = ApplyInternship::where('user_id', $user_id)
                ->where('internship_id', $job->id)
                ->exists();

            $job->is_saved = $is_saved;
            $job->is_applied = $is_applied;
        }

        return response([
            'error' => false,
            'data' => $jobs,
            'message' => 'Internship data fetched successfully',
        ]);
    } catch (\Exception $e) {
        return response([
            'message' => 'Something went wrong: ' . $e->getMessage(),
            'error' => true
        ]);
    }
}
   public function updataEployerIntern(Request $request)
{
    $data = Internship::find($request->id);
 

    $data->who_can_apply = $request->who_can_apply;
    $data->information = $request->information;
    $data->location = $request->location;
    $data->perks = $request->perks;
    $data->website = $request->website;
    $data->internship_title = $request->internship_title;
    $data->internship_type = $request->internship_type;
    $data->openings = $request->openings;
    $data->duration = $request->duration;
    $data->stipend = $request->stipend;
    $data->skill = $request->skill;
     $data->last_date = $request->last_date;
  $data->about_internship = $request->about;
    $data->category_id = $request->category_id;
    $data->save();
} 
    

}