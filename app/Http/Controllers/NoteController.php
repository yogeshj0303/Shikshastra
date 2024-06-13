<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\NoteDetail;
use App\Models\Subject;
use App\Models\Chapter;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function frontIndex(Request $request){

        $getChapter = DB::table('notes')->where('chapter_id', $request->chapterID)->first();
        $getSubjectChater = DB::table('chapters')->where('subject_id', $getChapter->subject_id)->get();
        $getClassChater = DB::table('subjects')->where('class_id', $getChapter->class_id)->get();
        foreach($getClassChater as $value){
            $subject = DB::table('categories')->where('id',$getChapter->class_id)->first();
            $value->class_name = $subject->name;
        }
       
        if(empty($getChapter)){
            return response()->json(['error' =>true,'msg'=> 'No Chapter Found!!']);
        }else{
            $getChapterDetails = DB::table('note_details')->where('note_id',$getChapter->id)->get();
            $getChapter->note_details=$getChapterDetails;
        }

        return view("frontend.chapter-details",compact("getChapter","getSubjectChater","getClassChater"));
    }
    public function index(){
        return view("admin.topic-details.index");
    }
    public function create(){
        return view("admin.topic-details.create");
    }


 private function convertToEmbedLink($url)
 {
     // Check if the URL contains the 'watch?v=' part
     if (strpos($url, 'watch?v=') !== false) {
         return str_replace('watch?v=', 'embed/', $url);
     }

     // Return the original URL if it's already in the embed format or invalid
     return $url;
 }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required|exists:categories,id',
            'subject_id' => 'required|exists:subjects,id',
            'chapter_id' => 'required|exists:chapters,id',
            'youtube_link' => 'required|url',
            'description' => 'required|string',
            'image' => 'array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);
    
        DB::transaction(function () use ($validatedData, $request) {
            $note = Note::create([
                'class_id' => $validatedData['class_id'],
                'subject_id' => $validatedData['subject_id'],
                'chapter_id' => $validatedData['chapter_id'],
                'youtube_link' => $this->convertToEmbedLink($validatedData['youtube_link']),
                'description' => $validatedData['description'],
            ]);
    
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $file) {
                    $ext = $file->getClientOriginalExtension();
                    $path = date('y-m-d') . '-' . rand() . '.' . $ext;
                    $file->move('uploads/Note-Images/', $path);
    
                    NoteDetail::create([
                        'note_id' => $note->id,
                        'image_path' => 'uploads/Note-Images/' . $path,
                    ]);
                }
            }
        });
    
        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }
    public function getSubjects($class_id)
    {
        $subjects = Subject::where('class_id', $class_id)->get();
        return response()->json($subjects);
    }

    public function getChapters($subject_id)
    {
        $chapters = Chapter::where('subject_id', $subject_id)->get();
        return response()->json($chapters);
    }

}
