<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SamplePaper;
use App\Models\SampleDetail;
use Illuminate\Support\Facades\DB;

class SamplePaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =  SamplePaper::with('category', 'subject')
        ->join('categories', 'sample_papers.class_id', '=', 'categories.id')
        ->join('subjects', 'sample_papers.subject_id', '=', 'subjects.id')
        ->select('sample_papers.*', 'categories.name as class_name', 'subjects.subject_name as subject_name')
        ->paginate(10);
        return view("admin.sample-papper.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.sample-papper.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'class_id' => 'required|exists:categories,id',
            'subject_id' => 'required|exists:subjects,id', // Assuming you have a subjects table
            'youtube_link' => 'nullable|url',
            'image.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:6028',
            'description' => 'required|string',
        ]);
    
        // Use a try-catch block to handle any exceptions
        try {
            // Store the sample paper data
            DB::transaction(function () use ($validatedData, $request) {
                $samplePaper = SamplePaper::create([
                    'class_id' => $validatedData['class_id'],
                    'subject_id' => $validatedData['subject_id'],
                    'youtube_link' => $validatedData['youtube_link'] ?? null,
                    'description' => $validatedData['description'],
                ]);
    
                $samplePaperNames = $request->input('sample_paper_name', []);
    
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $key => $file) {
                        $ext = $file->getClientOriginalExtension();
                        $path = date('y-m-d') . '-' . uniqid() . '.' . $ext;
                        $file->move('uploads/Note-Images/', $path);
    
                        SampleDetail::create([
                            'sample_id' => $samplePaper->id,
                            'sample_paper_name' =>  $samplePaperNames[$key] ?? 'Default Name',
                            'image_path' => 'uploads/Note-Images/' . $path,
                        ]);
                    }
                }
            });
    
            return redirect()->route('sample-paper.index')->with('success', 'Sample Paper added successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error adding sample paper: ' . $e->getMessage());
    
            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while adding the sample paper. Please try again.']);
        }
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        $samplePaper = SamplePaper::with('details')->findOrFail($id);
        $classes = DB::table('categories')->get();
        $subjects = DB::table('subjects')->where('class_id', $samplePaper->class_id)->get();
        
        return view('admin.sample-papper.edit', compact('samplePaper', 'classes', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'class_id' => 'required|exists:categories,id',
            'subject_id' => 'required|exists:subjects,id',
            'youtube_link' => 'nullable|url',
            'image.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,docx|max:6028',
            'description' => 'required|string',
            'deleted_images.*' => 'nullable|exists:sample_details,id',
        ]);
    
        // Use a try-catch block to handle any exceptions
        try {
            // Update the sample paper data
            DB::transaction(function () use ($validatedData, $request, $id) {
                $samplePaper = SamplePaper::findOrFail($id);
                $samplePaper->update([
                    'class_id' => $validatedData['class_id'],
                    'subject_id' => $validatedData['subject_id'],
                    'youtube_link' => $validatedData['youtube_link'] ?? null,
                    'description' => $validatedData['description'],
                ]);

                // Handle existing images deletion
                if ($request->has('deleted_images')) {
                    $deletedImages = $request->input('deleted_images');
                    foreach ($deletedImages as $imageId) {
                        $image = SampleDetail::findOrFail($imageId);
                        // Uncomment to delete file from storage if needed
                        // Storage::delete($image->image_path);
                        $image->delete();
                    }
                }

                // Handle new images upload
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $key => $file) {
                        $ext = $file->getClientOriginalExtension();
                        $path = date('y-m-d') . '-' . uniqid() . '.' . $ext;
                        $file->move('uploads/Note-Images/', $path);

                        SampleDetail::create([
                            'sample_id' => $samplePaper->id,
                            'sample_paper_name' => $request->input('sample_paper_name')[$key] ?? 'Default Name',
                            'image_path' => 'uploads/Note-Images/' . $path,
                        ]);
                    }
                }
            });
    
            return redirect()->route('sample-paper.index')->with('success', 'Sample Paper updated successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating sample paper: ' . $e->getMessage());
    
            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the sample paper. Please try again.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
{
    // Fetch the sample paper by ID
    $samplePaper = SamplePaper::findOrFail($id);

    // Use a transaction to ensure data consistency
    DB::transaction(function () use ($samplePaper) {
        // Check if $samplePaper->details is not null before iterating
        if ($samplePaper->details) {
            // Delete associated details (images) from storage and database
            foreach ($samplePaper->details as $detail) {
                // Delete image file from storage if needed
                // Storage::delete($detail->image_path); // Uncomment if using Storage facade
                $detail->delete();
            }
        }

        // Now delete the sample paper itself
        $samplePaper->delete();
    });

    return redirect()->route('sample-paper.index')->with('success', 'Sample Paper deleted successfully.');
}

}
