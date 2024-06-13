<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Company;
use App\Models\Review;
  use Carbon\Carbon;
class FaqController extends Controller

{




    public function faq(Request $request)
    {
        $expert = Faq::all();
        if ($expert) {

                    return response()->json(['error' => false, 'data' =>$expert]);
                } else {

                    return response()->json(['error' => true, 'result'=>"Data not found"]);
                    }
    }
    
     public function category(Request $request)
    {
        $expert = Category::all();
        if ($expert) {

                    return response()->json(['error' => false, 'data' =>$expert]);
                } else {

                    return response()->json(['error' => true, 'result'=>"Data not found"]);
                    }
    }
    
     public function logo(Request $request)
    {
        $expert = Company::all();
        if ($expert) {

                    return response()->json(['error' => false, 'data' =>$expert]);
                } else {

                    return response()->json(['error' => true, 'result'=>"Data not found"]);
                    }
    }
    

public function reviewData(Request $request)
{
    $experts = Review::all();

    if ($experts) {
       
        // Format the date for each review
        $formattedExperts = $experts->map(function ($expert) {
            $formattedDate = \Carbon\Carbon::parse($expert->created_at)->format('j M Y');
            $expert->date = $formattedDate;
            return $expert;
        });

        return response()->json(['error' => false, 'data' => $formattedExperts]);
    } else {
        return response()->json(['error' => true, 'result' => "Data not found"]);
    }
}










}
