<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Preference;
use App\Models\User;


class CarrerController extends Controller

{
   
public function preference(Request $request)
{
    $user_id = $request->user_id;
    $category_id = $request->category_id;

    // Check if the user already has this category_id
    $existingPreference = Preference::where('user_id', $user_id)
                                    ->where('category_id', $category_id)
                                    ->first();

    if ($existingPreference) {
        // Category_id already exists for this user, you can return a message here.
        return response([
            'message' => "Category already added for this user",
            'error' => false
        ]);
    }

    // If not, create a new preference
    $experience = new Preference;
    $experience->user_id = $user_id;
    $experience->category_id = $category_id;

    if ($experience->save()) {
        return response([
            'data' => $experience,
            'message' => "Preference added successfully",
            'error' => false
        ]);
    } else {
        return response([
            'message' => "Something went wrong",
            'error' => true
        ]);
    }
}


 public function carrer(Request $request)
{
    $expert = Preference::with('category') // Eager load the 'category' relationship
        ->where('user_id', $request->user_id)
        ->get();

    if ($expert) {
        return response()->json(['error' => false, 'data' => $expert]);
    } else {
        return response()->json(['error' => true, 'result' => "Data not found"]);
    }
}

public function removePreference(Request $request)
{
    $preference = Preference::where('user_id', $request->user_id)
        ->where('id', $request->preference_id)
        ->first();

    if ($preference) {
        $preference->delete();
        return response()->json(['error' => false, 'message' => 'Preference removed successfully']);
    } else {
        return response()->json(['error' => true, 'message' => 'Preference not found']);
    }
}


}