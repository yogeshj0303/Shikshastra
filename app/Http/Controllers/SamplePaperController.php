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
        $data = SamplePaper::paginate(10);
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
        'class_id' => 'required',
        'subject_id' => 'required',
        'sample_paper_name' => 'required',
        'youtube_link' => 'required',
        'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation as needed
        'description' => 'required',
    ]);

    // Store the sample paper data
    DB::transaction(function () use ($validatedData, $request) {
        $note = SamplePaper::create([
            'class_id' => $validatedData['class_id'],
            'subject_id' => $validatedData['subject_id'],
            'sample_paper_name' => $validatedData['sample_paper_name'],
            'youtube_link' => 'nullable|url',
            'description' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $ext = $file->getClientOriginalExtension();
                $path = date('y-m-d') . '-' . rand() . '.' . $ext;
                $file->move('uploads/Note-Images/', $path);

                SampleDetail::create([
                    'sample_id' => $note->id,
                    'image_path' => 'uploads/Note-Images/' . $path,
                ]);
            }
        }
    });

    return redirect()->route('sample-paper.index')->with('success', 'Sample Paper added successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
