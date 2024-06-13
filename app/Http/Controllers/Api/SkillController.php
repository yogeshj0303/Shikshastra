<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quality;
use App\Models\User;
use App\Models\Skill;

class SkillController extends Controller

{
   public function addSkill(Request $request)
{
    $user_id = $request->user_id;
    $skill = $request->skill;
     
 // Check if the user already has this category_id
    $existingPreference = Quality::where('user_id', $user_id)
                                    ->where('skill', $skill)
                                   
                                    ->first();

    if ($existingPreference) {
        // Category_id already exists for this user, you can return a message here.
        return response([
            'message' => "Skill already added for this user",
            'error' => true
        ]);
    }
        $quality = new Quality;
        $quality->user_id = $request->user_id;
        $quality->skill = $request->skill;
        $quality->skill_level = $request->skill_level;

        if ($quality->save()) {
            return response([
                'data' => $quality,
                'message' => "Skill Added Successfully",
                'error' => false
            ]);
        } else {
            return response([
                'message' => "Something went wrong",
                'error' => true
            ]);
        }
    }


    


public function showSkill(Request $request)
{
    $user = User::where('id', $request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    $education = Quality::where('user_id', $request->user_id)->get();

    return response([
        'data' => $education,
        'message' => "Skill retrieved successfully",
        'error' => false
    ]);
}

public function deleteOneSkill(Request $request ,$id)
{
    

   

  $education=Quality::find($request->skillId);

    $education->delete();

    return response([
        'message' => "Experience record deleted successfully",
        'error' => false
    ]);
}


    public function checkSkillBelongsToUser(Request $request)
    {
        $user_id = $request->input('user_id');
        $skill_id = $request->input('skill_id');

        // Retrieve the skill from the database
        $skill = Quality::find($skill_id);

        if ($skill && $skill->user_id === $user_id) {
            return response()->json(['belongs' => true]);
        } else {
            return response()->json(['belongs' => false]);
        }
    }











public function deleteSkill(Request $request)
{
    $user = User::where('id', $request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    $education = Quality::where('id', $request->quality_id)->where('user_id', $request->user_id)->first();

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


 public function editSkill(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if (!$user) {
            return response([
                'message' => "User not found",
                'error' => true
            ]);
        }

        $experience = Quality::where('id', $request->quality_id)
            ->where('user_id', $request->user_id)
            ->first();

        if (!$experience) {
            return response([
                'message' => "Quality record not found",
                'error' => true
            ]);
        }

        $experience->update([
            'skill' => $request->skill,
            'skill_level' => $request->skill_level,
           
        ]);

        return response([
            'data' => $experience,
            'message' => "Skill record updated successfully",
            'error' => false
        ]);
    }



    public function skill(Request $request)
    {
        $expert = Skill::all();
        if ($expert) {

                    return response()->json(['error' => false, 'data' =>$expert]);
                } else {

                    return response()->json(['error' => true, 'result'=>"Data not found"]);
                    }
    }

}
