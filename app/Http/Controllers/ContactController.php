<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Contact::all();
        return view('admin.contact.form',compact('data'));
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
        $data = new Contact;
        $data->name = $request->name;
        $data->lastname = $request->lastname;
        $data->com_name = $request->com_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->subject = $request->subject;
        $data->message = $request->message;
        if($data->save()){
            return redirect()->back()->with('Message', " Thank You for contacting.");
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
        $data = Contact::find($id);
       if ($data->delete()){
        return redirect()->back()->with('Message', "Category deleted successfully.");
       }
       else{
        return redirect()->back()->with('Error', "Something went wrong.");
       }

    }
}
