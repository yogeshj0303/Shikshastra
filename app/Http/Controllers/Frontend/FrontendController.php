<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    //
    public function index(Request $request){
        $subjectId = $request->subjectId; // Assuming you're retrieving subject ID from the request

        $getSubject = DB::table("chapters")->where('subject_id',$subjectId)->get();
        
        if (empty($getSubject) || !isset($getSubject[0])) {
            // Handle no chapters case (empty view, message, etc.)
            return view('frontend.subjectlist', compact('getSubject')); // Pass empty $getSubject for potential view logic
        }
        
        $getClassName = DB::table('categories')->where('id',$getSubject[0]->class_id)->first();
        $getRelatedSubject = DB::table('subjects')->where('class_id',$getClassName->id)->get();
        $getSubjectName = DB::table('subjects')->where('id',$request->subjectId)->first();
        return view("frontend.subjectlist",compact("getSubject","getClassName","getSubjectName","getRelatedSubject"));
    }

public function getSubject(Request $request){
$getSubject = DB::table("subjects")->where("class_id",$request->classId)->get();
return view("frontend.subjects",compact("getSubject"));
}

}
