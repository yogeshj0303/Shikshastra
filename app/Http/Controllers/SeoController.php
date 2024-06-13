<?php

namespace App\Http\Controllers;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $seo = Seo::all();
        return view("admin.seo.index", compact("seo"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'meta_title' => 'required',
            'meta_desc' => 'required',
            'meta_keyword' => 'required',
            'page_name' => 'required',
        ]);
    
        // Check if a record with the given page_name already exists
        $seo = Seo::where('page_name', $request->page_name)->first();
    
        if ($seo) {
            // If the record exists, update it
            $seo->meta_title = $request->meta_title;
            $seo->meta_keyword = $request->meta_keyword;
            $seo->meta_desc = $request->meta_desc;
            $seo->save();
    
            return redirect()->back()->with('success', 'Meta Tags Updated Successfully');
        } else {
            // If the record does not exist, create a new one
            $seo = new Seo;
            $seo->meta_title = $request->meta_title;
            $seo->meta_keyword = $request->meta_keyword;
            $seo->meta_desc = $request->meta_desc;
            $seo->page_name = $request->page_name; // Ensure to set the page_name
            $seo->save();
    
            return redirect()->back()->with('success', 'Meta Tags Created Successfully');
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
