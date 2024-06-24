<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\NoteDetail;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Category;
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
    
    
public function edit($id)
{
    try {
        $note = Note::with('details')->findOrFail($id);
        $classes = Category::all(); // Assuming Category model corresponds to 'categories' table
        $subjects = Subject::where('class_id', $note->class_id)->get(); // Assuming Subject model and 'class_id' column
        $chapters = Chapter::where('subject_id', $note->subject_id)->get(); // Assuming Chapter model and 'subject_id' column
        
        return view('admin.topic-details.edit', compact('note', 'classes', 'subjects', 'chapters'));
    } catch (\Exception $e) {
        return redirect()->route('notes.index')->with('error', 'Note not found.'); // Handle error if note is not found
    }
}


    // Update method to handle the form submission
public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'class_id' => 'required|exists:categories,id',
        'subject_id' => 'required|exists:subjects,id',
        'chapter_id' => 'required|exists:chapters,id',
        'youtube_link' => 'required|url',
        'description' => 'required|string',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
    ]);

    DB::beginTransaction();

    try {
        $note = Note::findOrFail($id);
        $note->class_id = $validatedData['class_id'];
        $note->subject_id = $validatedData['subject_id'];
        $note->chapter_id = $validatedData['chapter_id'];
        $note->youtube_link = $this->convertToEmbedLink($validatedData['youtube_link']);
        $note->description = $validatedData['description'];
        $note->save();

        // Handle existing images deletion
        if ($request->has('existing_images')) {
            foreach ($request->input('existing_images') as $imageId) {
                // Assuming NoteDetail is the model for image details
                $image = NoteDetail::findOrFail($imageId);
                // Delete the image file from storage if needed
                // Storage::delete($image->image_path); // Uncomment if using Storage facade
                $image->delete();
            }
        }

        // Handle new images
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

        DB::commit();
        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withInput()->with('error', 'Failed to update note. Please try again.');
    }
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

public function destroy($id)
{
    $note = Note::findOrFail($id);

    DB::transaction(function () use ($note) {
        // Delete related note details
        foreach ($note->details as $detail) {
            // Delete the image file if needed
            if (file_exists(public_path($detail->image_path))) {
                unlink(public_path($detail->image_path));
            }
            $detail->delete();
        }

        // Delete the note itself
        $note->delete();
    });

    return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
}



}
