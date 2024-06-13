<?php

namespace App\Http\Controllers;
use App\Models\Faq;
use App\Models\Location;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Faq::orderBy('id','DESC')->paginate(10);
        return view('admin.faq.index',compact('data'));
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
        
        
         $request->validate([
            'class_id' => 'required',
         'question' => 'required',
        'answer' => 'required',
        
    ]);

            $data = new Faq;

            $data->question = $request->class_id;
            $data->question = $request->question;
            $data->answer = $request->answer;
            if($data->save()){
                return redirect()->back()->with('Message', "FAQ Added Successfully.");
            }
            else{
                return redirect()->back()->with('Error', "Something went wrong.");
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
          $data= Faq::where('id',$id)->first(); 
      return view('admin.faq.edit',compact('data'));
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
            
        
         $request->validate([
            'class_id' => 'required',
         'question' => 'required',
        'answer' => 'required',
        
    ]);

            $data = Faq::where('id',$id)->first();

            $data->question = $request->class_id;
            $data->question = $request->question;
            $data->answer = $request->answer;
            if($data->save()){
                return redirect()->route('faq.index')->with('Message', " FAQ Updated Successfully.");
            }
            else{
                return redirect()->back()->with('Error', "Something went wrong.");
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
        $data = Faq::find($id);
        if ($data->delete()){
         return redirect()->back()->with('Message', "Faq deleted successfully.");
        }
        else{
         return redirect()->back()->with('Error', "Something went wrong.");
        }
    }
}
