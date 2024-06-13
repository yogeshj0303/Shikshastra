<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Education;
use App\Models\Document;

class EducationController extends Controller

{
   
   public function Education(Request $request)
{
    $user = User::where('id', $request->user_id)->first();
    
    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
        
    } 

    $experience = new Education;
    $experience->user_id = $request->user_id;
    $experience->name = $request->name;
    $experience->start_date = $request->start_date;
    $experience->end_date = $request->end_date;
    $experience->degree = $request->degree;
    $experience->stream = $request->stream;
    $experience->percentage = $request->percentage;
    $experience->save();
    
    

    if ($experience) {
        return response([
            'data' => $experience,
            'message' => " Education added Successfully",
            'error' => false
        ]);
    } else {
        return response([
            'message' => "Something went wrong",
            'error' => true
        ]);
    }
}

public function addAbout(Request $request)
{
    $user = User::where('id', $request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    // Check if the document already exists for the user
    $existingDocument = User::where('id', $request->user_id)->update([
        'fname'=>$user->fname,
        'lname'=>$user->lname,
        'email'=>$user->email,
        'image'=>$user->image,
        'cv'=>$user->phone_number,
        'password'=>$user->password,
        'description'=>$user->descroption,
        'location'=>$user->location,
        'about_us'=>$request->about_us]);

        return response([
            'message' => "About added successfully",
            'error' => false
        ]);
    }


















public function addDoc(Request $request)
{
    $user = User::where('id', $request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    // Check if the document already exists for the user
    $existingDocument = Document::where('user_id', $request->user_id)->first();

    if ($existingDocument) {
        // Update the existing document
        if ($request->hasFile('doc')) {
            // Handle file upload and update the document here as needed
            $doc = $request->file('doc');
            $ext = $doc->getClientOriginalExtension();
            $doc_name = date('y-m-d') . '-' . rand() . '.' . $ext;
            $doc->move('uploads/doc/', $doc_name);
            $existingDocument->doc = $doc_name;
            $existingDocument->save();
        }
        return response([
            'message' => "Document updated successfully",
            'error' => false
        ]);
    } else {
        // Create a new document
        $data = new Document;
        $data->user_id = $request->user_id;

        if ($request->hasFile('doc')) {
            // Handle file upload for a new document
            $doc = $request->file('doc');
            $ext = $doc->getClientOriginalExtension();
            $doc_name = date('y-m-d') . '-' . rand() . '.' . $ext;
            $doc->move('uploads/doc/', $doc_name);
            $data->doc = $doc_name;
        }

        $data->save();

        return response([
            'message' => "Document added successfully",
            'error' => false
        ]);
    }
}






public function showEducation(Request $request)
{
    $user = User::where('id', $request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    $education = Education::where('user_id', $request->user_id)->get();

    return response([
        'data' => $education,
        'message' => "Education retrieved successfully",
        'error' => false
    ]);
}
public function deleteDoc(Request $request ,$id)
{
    

   

  $education=Document::find($request->docId);

    $education->delete();

    return response([
        'message' => "Document record deleted successfully",
        'error' => false
    ]);
}


public function deleteOneEdu(Request $request ,$id)
{
    

   

  $education=Education::find($request->eduId);

    $education->delete();

    return response([
        'message' => "Education record deleted successfully",
        'error' => false
    ]);
}



public function deleteEducation(Request $request)
{
    $user = User::where('id', $request->user_id)->first();

    if (!$user) {
        return response([
            'message' => "User not found",
            'error' => true
        ]);
    }

    $education = Education::where('id', $request->education_id)->where('user_id', $request->user_id)->first();

    if (!$education) {
        return response([
            'message' => "Education record not found",
            'error' => true
        ]);
    }

    $education->delete();

    return response([
        'message' => "Education record deleted successfully",
        'error' => false
    ]);
}




 public function editEducation(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if (!$user) {
            return response([
                'message' => "User not found",
                'error' => true
            ]);
        }

        $experience = Education::where('id', $request->education_id)
            ->where('user_id', $request->user_id)
            ->first();

        if (!$experience) {
            return response([
                'message' => "Education record not found",
                'error' => true
            ]);
        }

        $experience->update([
            'name' => $request->name,
            'degree' => $request->degree,
            'stream' => $request->stream,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'percentage' => $request->percentage,
            
        ]);

        return response([
            'data' => $experience,
            'message' => "Education record updated successfully",
            'error' => false
        ]);
    }

}
