<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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

public function getSamplePaper(Request $request)
{
    $getClassName = DB::table("categories")->where("id",$request->sample_id)->first();
    // Fetch subjects based on class_id
    $subjects = DB::table("subjects")->where('class_id', $request->sample_id)->get();
  
    // Fetch class names and sample papers in one go
    $subjects->each(function($subject) {
        // Fetch class name for the subject
        $class = DB::table('categories')->where('id', $subject->class_id)->first();
        $subject->class_name = $class->name;

        // Fetch sample papers for the subject
        $samplePapers = DB::table("sample_papers")->where('class_id',$subject->class_id)->where('subject_id', $subject->id)->get();

        // Fetch sample details for each sample paper
        $samplePapers->each(function($samplePaper) {
            $sampleDetails = DB::table('sample_details')->where('sample_id', $samplePaper->id)->get();
            $samplePaper->sample_details = $sampleDetails;
        });

        $subject->sample_papers = $samplePapers;
    });
    // dd($subjects);
    return view('frontend.sample-paper', compact('subjects','getClassName'));
}


}
