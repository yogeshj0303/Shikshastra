<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Company;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index()
    {
        $company= Company::orderBy('id','DESC')->paginate(10);
        return view('admin.company.index',compact('company'));
    }
   
    

    public function Companylogo(Request $request){
        $request->validate([
    'logo' => 'file|mimetypes:image/webp,application/aivf',
]);
        $data = new Company;
      
       
        if ($request->hasfile('logo')) {



            $image = $request->file('logo');

            $ext = $image->getClientOriginalExtension();

            $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

            $image->move('uploads/images/', $image_name);

            $data->logo = $image_name;

        }
        if($data->save()){
            return redirect('company')->with('Message', "Logo Added Successfully.");
        }
        else{
            return redirect()->back()->with('Error', "Something went wrong.");
        }


    }
    public function edit($id)
    {
        $company= Company::find($id);
        return view('admin.company.edit',compact('company'));
    }
    
    
    public function Update(Request $request,$id){
 $request->validate([
    'logo' => 'file|mimetypes:image/webp,application/aivf',
]);
        $data =Company::find($id);
      
       
        if ($request->hasfile('logo')) {



            $image = $request->file('logo');

            $ext = $image->getClientOriginalExtension();

            $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;

            $image->move('uploads/images/', $image_name);

            $data->logo = $image_name;

        }
        if($data->save()){
            return redirect('company')->with('Message', "Logo Update Successfully.");
        }
        else{
            return redirect()->back()->with('Error', "Something went wrong.");
        }


    }
   
    public function destroy($id)
    {
         //
        $data = Company::find($id);
       if ($data->delete()){
        return redirect()->back()->with('Message', "Logo deleted successfully.");
       }
       else{
        return redirect()->back()->with('Error', "Something went wrong.");
       }

    }
  

}
