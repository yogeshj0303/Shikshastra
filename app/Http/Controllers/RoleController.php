<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\AddRole;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Session;

class RoleController extends Controller
{
    public function index()
    {
        if(Session::get('adminId')){
        $data= AddRole::all();
        return view('admin.Role.index',compact('data'));
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}
    
    
     public function create()
    {if(Session::get('adminId')){
        $data= AddRole::all();
        return view('admin.Role.add',compact('data'));
   }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    } }


    public function store(Request $request){
        if(Session::get('adminId')){
        $request->validate([
            
    'name' => 'required',

]);
 $data = $request->all();
        $result = new AddRole;
         if(isset($data['dash_show'])){

        $result->dash_show = $data['dash_show'];

       }
        
               if(isset($data['role_show'])){

        $result->role_show = $data['role_show'];

       }
         if(isset($data['role_add'])){

        $result->role_add = $data['role_add'];

       }
        if(isset($data['role_edit'])){

        $result->role_edit = $data['role_edit'];

       } if(isset($data['role_delete'])){

        $result->role_delete = $data['role_delete'];

       }
       
       
        if(isset($data['view_skill'])){

        $result->view_skill = $data['view_skill'];

       }
         if(isset($data['add_skill'])){

        $result->add_skill = $data['add_skill'];

       }
        if(isset($data['delete_skill'])){

        $result->delete_skill = $data['delete_skill'];

       }
       
       
        if(isset($data['view_internship'])){

        $result->view_internship = $data['view_internship'];

       }
         if(isset($data['add_internship'])){

        $result->add_internship = $data['add_internship'];

       }
        if(isset($data['edit_internship'])){

        $result->edit_internship = $data['edit_internship'];

       } if(isset($data['delete_internship'])){

        $result->delete_internship = $data['delete_internship'];

       }
       
       
       
          
        if(isset($data['view_location'])){

        $result->view_location = $data['view_location'];

       }
         if(isset($data['add_location'])){

        $result->add_location = $data['add_location'];

       }
         if(isset($data['delete_location'])){

        $result->delete_location = $data['delete_location'];

       }
       
       
       
        
        if(isset($data['view_job'])){

        $result->view_job = $data['view_job'];

       }
         if(isset($data['add_job'])){

        $result->add_job = $data['add_job'];

       }
        if(isset($data['edit_job'])){

        $result->edit_job = $data['edit_job'];

       } if(isset($data['delete_job'])){

        $result->delete_job = $data['delete_job'];

       }
       
       
       
       
        
        if(isset($data['view_employer'])){

        $result->view_employer = $data['view_employer'];

       }
         if(isset($data['add_employer'])){

        $result->add_employer = $data['add_employer'];

       }
        if(isset($data['edit_employer'])){

        $result->edit_employer = $data['edit_employer'];

       } if(isset($data['delete_employer'])){

        $result->delete_employer = $data['delete_employer'];

       } 
       
       
       if(isset($data['view_employee'])){

        $result->view_employee = $data['view_employee'];

       }
         if(isset($data['add_employee'])){

        $result->add_employee = $data['add_employee'];

       }
        if(isset($data['edit_employee'])){

        $result->edit_employee = $data['edit_employee'];

       } if(isset($data['delete_employee'])){

        $result->delete_employee = $data['delete_employee'];

       } 
       
       
        if(isset($data['view_user'])){

        $result->view_user = $data['view_user'];

       }
 if(isset($data['delete_user'])){

        $result->delete_user = $data['delete_user'];

       } 
       
       
        if(isset($data['view_story'])){

        $result->view_story = $data['view_story'];

       }
         if(isset($data['add_story'])){

        $result->add_story = $data['add_story'];

       }
        if(isset($data['edit_story'])){

        $result->edit_story = $data['edit_story'];

       } if(isset($data['delete_story'])){

        $result->delete_story = $data['delete_story'];

       } 
       
       
       
          if(isset($data['cat_add'])){

        $result->cat_add = $data['cat_add'];

       }
         if(isset($data['cat_show'])){

        $result->cat_show = $data['cat_show'];

       }
        if(isset($data['cat_delete'])){

        $result->cat_delete = $data['cat_delete'];

       } 
       
       
         if(isset($data['camp_add'])){

        $result->camp_add = $data['camp_add'];

       }
         if(isset($data['camp_show'])){

        $result->camp_show = $data['camp_show'];

       }
        if(isset($data['camp_delete'])){

        $result->camp_delete = $data['camp_delete'];

       } 
       
       
           if(isset($data['faq_add'])){

        $result->faq_add = $data['faq_add'];

       }
         if(isset($data['faq_show'])){

        $result->faq_show = $data['faq_show'];

       }
        if(isset($data['faq_delete'])){

        $result->faq_delete = $data['faq_delete'];

       }
       
       
       
           if(isset($data['up_plan_add'])){

        $result->up_plan_add = $data['up_plan_add'];

       }
         if(isset($data['up_plan_show'])){

        $result->up_plan_show = $data['up_plan_show'];

       }
        if(isset($data['up_plan_delete'])){

        $result->up_plan_delete = $data['up_plan_delete'];

       }
        if(isset($data['up_plan_edit'])){

        $result->up_plan_edit = $data['up_plan_edit'];

       }
    
    
    
           if(isset($data['test_add'])){

        $result->test_add = $data['test_add'];

       }
         if(isset($data['test_show'])){

        $result->test_show = $data['test_show'];

       }
        if(isset($data['test_delete'])){

        $result->test_delete = $data['test_delete'];

       }
      
       
        if(isset($data['bolg_show'])){

        $result->bolg_show = $data['bolg_show'];

       }
         if(isset($data['blog_add'])){

        $result->blog_add = $data['blog_add'];

       }
        if(isset($data['blog_edit'])){

        $result->blog_edit = $data['blog_edit'];

       } if(isset($data['blog_delete'])){

        $result->blog_delete = $data['blog_delete'];

       }
       
        if(isset($data['cat_bolg_show'])){

        $result->cat_bolg_show = $data['cat_bolg_show'];

       }
         if(isset($data['cat_blog_add'])){

        $result->cat_blog_add = $data['cat_blog_add'];

       }
        if(isset($data['cat_blog_delete'])){

        $result->cat_blog_delete = $data['cat_blog_delete'];

       }
       
        $result->name = $request->name;
     
       
        if($result->save()){
            return redirect('addrole')->with('Message', "Role added  Successfully.");
        }
        else{
            return redirect()->back()->with('Error', "Something went wrong.");
        }
 }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }

    }
  
    public function destroy($id)
    {
        if(Session::get('adminId')){
         //
        $data = AddRole::find($id);
       if ($data->delete()){
        return redirect()->back()->with('Message', "Role deleted successfully.");
       }
       else{
        return redirect()->back()->with('Error', "Something went wrong.");
       }

     }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }}
    
    
    
 public function edit($id)
    {
        if(Session::get('adminId')){  
         $row=AddRole::find($id);
     
        return view('admin.Role.edit',compact('row'));
        }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
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
    if(Session::get('adminId')){ 
        $data = $request->all();
        $result = Addrole::find($id);

        $originalValues = $result->toArray();

        // Update the attributes with new values
        if (isset($data['dash_show'])) {
            $result->dash_show = $data['dash_show'];
        } else {
            $result->dash_show = 1;
        }
       
       
        if(isset($data['role_show'])){

        $result->role_show = $data['role_show'];

       }else{
        $result->role_show = 1;
       }
         if(isset($data['role_add'])){

        $result->role_add = $data['role_add'];

       }else{
        $result->role_add = 1;
       }
        if(isset($data['role_edit'])){

        $result->role_edit = $data['role_edit'];

       }else{
        $result->role_edit = 1;
       } if(isset($data['role_delete'])){

        $result->role_delete = $data['role_delete'];

       }else{
        $result->role_delete = 1;
       }
      


        if(isset($data['view_skill'])){

        $result->view_skill = $data['view_skill'];

       }else{
        $result->view_skill = 1;
       }
         if(isset($data['add_skill'])){

        $result->add_skill = $data['add_skill'];

       }else{
        $result->add_skill = 1;
       }
        if(isset($data['delete_skill'])){

        $result->delete_skill = $data['delete_skill'];

       }else{
        $result->delete_skill = 1;
       }
       
       
        if(isset($data['view_internship'])){

        $result->view_internship = $data['view_internship'];

       }else{
        $result->view_internship = 1;
       }
         if(isset($data['add_internship'])){

        $result->add_internship = $data['add_internship'];

       }else{
        $result->add_internship = 1;
       }
        if(isset($data['edit_internship'])){

        $result->edit_internship = $data['edit_internship'];

       }else{
        $result->edit_internship = 1;
       }
       if(isset($data['delete_internship'])){

        $result->delete_internship = $data['delete_internship'];

       }
       else{
        $result->delete_internship = 1;
       }
       
       
       
              
        if(isset($data['view_location'])){

        $result->view_location = $data['view_location'];

       }
       else{
        $result->view_location = 1;
       }
         if(isset($data['add_location'])){

        $result->add_location = $data['add_location'];

       }
       else{
        $result->add_location = 1;
       }
         if(isset($data['delete_location'])){

        $result->delete_location = $data['delete_location'];

       }
       else{
        $result->delete_location = 1;
       }
       
       
       
        
        if(isset($data['view_job'])){

        $result->view_job = $data['view_job'];

       }
       else{
        $result->view_job = 1;
       }
         if(isset($data['add_job'])){

        $result->add_job = $data['add_job'];

       }
       else{
        $result->add_job = 1;
       }
        if(isset($data['edit_job'])){

        $result->edit_job = $data['edit_job'];

       } 
       else{
        $result->edit_job = 1;
       }
       if(isset($data['delete_job'])){

        $result->delete_job = $data['delete_job'];

       }
       else{
        $result->delete_job = 1;
       }
       
       
       
       
        
        if(isset($data['view_employer'])){

        $result->view_employer = $data['view_employer'];

       }
       else{
        $result->view_employer = 1;
       }
         if(isset($data['add_employer'])){

        $result->add_employer = $data['add_employer'];

       }
       else{
        $result->add_employer = 1;
       }
        if(isset($data['edit_employer'])){

        $result->edit_employer = $data['edit_employer'];

       }
       else{
        $result->edit_employer = 1;
       }
       if(isset($data['delete_employer'])){

        $result->delete_employer = $data['delete_employer'];

       } 
       else{
        $result->delete_employer = 1;
       }
       
       
        if(isset($data['view_employee'])){

        $result->view_employee = $data['view_employee'];

       }
       else{
        $result->view_employee = 1;
       }
 if(isset($data['delete_employee'])){

        $result->delete_employee = $data['delete_employee'];

       } 
       else{
        $result->delete_employee = 1;
       }
       
        if(isset($data['view_story'])){

        $result->view_story = $data['view_story'];

       }
       else{
        $result->view_story = 1;
       }
         if(isset($data['add_story'])){

        $result->add_story = $data['add_story'];

       }
       else{
        $result->add_story = 1;
       }
        if(isset($data['edit_story'])){

        $result->edit_story = $data['edit_story'];

       }
       else{
        $result->edit_story = 1;
       }
       if(isset($data['delete_story'])){

        $result->delete_story = $data['delete_story'];

       } 
       else{
        $result->delete_story = 1;
       }



          if(isset($data['cat_add'])){

        $result->cat_add = $data['cat_add'];

       } else{
        $result->cat_add = 1;
       }
         if(isset($data['cat_show'])){

        $result->cat_show = $data['cat_show'];

       } else{
        $result->cat_show = 1;
       }
        if(isset($data['cat_delete'])){

        $result->cat_delete = $data['cat_delete'];

       }  else{
        $result->cat_delete = 1;
       }
       
       
         if(isset($data['camp_add'])){

        $result->camp_add = $data['camp_add'];

       } else{
        $result->camp_add = 1;
       }
         if(isset($data['camp_show'])){

        $result->camp_show = $data['camp_show'];

       } else{
        $result->camp_show = 1;
       }
        if(isset($data['camp_delete'])){

        $result->camp_delete = $data['camp_delete'];

       }  else{
        $result->camp_delete = 1;
       }
       
       
           if(isset($data['faq_add'])){

        $result->faq_add = $data['faq_add'];

       } else{
        $result->faq_add = 1;
       }
         if(isset($data['faq_show'])){

        $result->faq_show = $data['faq_show'];

       } else{
        $result->faq_show = 1;
       }
        if(isset($data['faq_delete'])){

        $result->faq_delete = $data['faq_delete'];

       } else{
        $result->faq_delete = 1;
       }
       
       
       
           if(isset($data['up_plan_add'])){

        $result->up_plan_add = $data['up_plan_add'];

       } else{
        $result->up_plan_add = 1;
       }
         if(isset($data['up_plan_show'])){

        $result->up_plan_show = $data['up_plan_show'];

       } else{
        $result->up_plan_show = 1;
       }
        if(isset($data['up_plan_delete'])){

        $result->up_plan_delete = $data['up_plan_delete'];

       } else{
        $result->up_plan_delete = 1;
       }
        if(isset($data['up_plan_edit'])){

        $result->up_plan_edit = $data['up_plan_edit'];

       } else{
        $result->up_plan_edit = 1;
       }
    
    
    
           if(isset($data['test_add'])){

        $result->test_add = $data['test_add'];

       } else{
        $result->test_add = 1;
       }
         if(isset($data['test_show'])){

        $result->test_show = $data['test_show'];

       } else{
        $result->test_show = 1;
       }
        if(isset($data['test_delete'])){

        $result->test_delete = $data['test_delete'];

       } else{
        $result->test_delete = 1;
       }


if(isset($data['bolg_show'])){


        $result->bolg_show = $data['bolg_show'];

       } else{
     $result->bolg_show = 1;
       }
         if(isset($data['blog_add'])){

        $result->blog_add = $data['blog_add'];

       }else{
       $result->blog_add = 1;
       }
        if(isset($data['blog_edit'])){

        $result->blog_edit = $data['blog_edit'];

       }else{
      $result->blog_edit = 1;
       } 
       if(isset($data['blog_delete'])){

        $result->blog_delete = $data['blog_delete'];

       }else{
       $result->blog_delete = 1;
       } 



if(isset($data['cat_bolg_show'])){


        $result->cat_bolg_show = $data['cat_bolg_show'];

       } else{
     $result->cat_bolg_show = 1;
       }
         if(isset($data['cat_blog_add'])){

        $result->cat_blog_add = $data['cat_blog_add'];

       }else{
       $result->cat_blog_add = 1;
       }
       
       if(isset($data['cat_blog_delete'])){

        $result->cat_blog_delete = $data['cat_blog_delete'];

       }else{
       $result->cat_blog_delete = 1;
       } 



  $result->name = $data['name'];

       
        $changesMade = ($originalValues != $result->toArray());

        if ($result->save()) {
            if ($changesMade) {
                return redirect()->route('addrole.index')->with('Message', 'Role updated successfully');
            } else {
                return redirect()->route('addrole.index')->with('Message', 'No changes were made');
            }
        } else {
            return redirect()->back();
        }
   }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }  }

    
    
  
    
        public function viewPermission($id)
    {
      if(Session::get('adminId')){
       $row=AddRole::find($id);
     
        return view('admin.Role.view',compact('row'));
    }else{
       return redirect('/admin-login')->with('Error', 'Login first');  
    }
        
    }
}

  


