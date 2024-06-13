@extends('admin.layout.layout')
@section('content')

<style>
    .table thead th {
    border-bottom: 1px solid #e2e5e8;
    font-size: 13px;
    color: #37474f;
    background: #f38e27;
    text-transform: uppercase;
}
.column1 {
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    background: #FFFFFF;
}

.top_row {
    /*width: 50%;*/
    display: flex;
    justify-content: center;
    text-align: center;
    height: 100%;
}

.top_row label {
    padding-right: 20px;
    padding-top: 27px;
}

.role_input {
    padding-top: 10px;
    
}

.role_input input {
    padding: 5px;
    margin-right: 20px;
    margin-top: 10px;
}

.task input {
    margin-right: 10px;
}

.task {
    padding-top: 7px;
}

.task label {
    margin-top: -2px;
}

.add_role_button {
    margin-bottom: 20px !important;
    text-align: center;
    display: flex;
    justify-content: center;
    margin: 0 auto;
}
</style>


   <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                            <div class="page-header-title">
                                <h5 class="m-b-10"> UpdateRole</h5>
                            </div>
                  
                        </div>
                    </div>
                </div>
            </div> 
                                        
                   
                     
<form action="{{route('addrole.update',$row->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                      
                     <div class="row column1">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                   
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                 <div class="col-md-6">
                        <div class="form-group row top_row">
                          <label class="col-sm-3 col-form-label">Role</label>
                          <div class="role_input">
                        <input class="from-group" type="text"name="name"placeholder="Enter new role name" value="{{$row->name}}" pattern="[A-Za-z\s\-]+" required/>
                          
                       <option value=""></option>
                 
                        </select>
                              </div>
                      
                      </div>
    </div>
                                    <div class="col-lg-12">
                                       <div class="table-responsive-sm">
                                          <table class="table table-striped projects">
                                        
                             <thead style="background-color:#005ce6">
                                  <tr><th class="text-white">Features</th>
                                     <th class="text-white">Capabilities</th>
                                  </tr>
                                  
                              </thead>
                             
                      <tbody>
                        <tr>
                    <td>Dashboard</td>  
                   <td>  <div class="task"><input type="checkbox"  name="dash_show" value="2"@if($row->dash_show==2) checked    @endif><lable >view</lable></div>
                    
                    </td>
                    </tr>
             
                       <tr>   <td>Roles</td>  
                    <td>
                   
                  <div class="task"><input type="checkbox"  name="role_show" value="2"@if($row->role_show==2) checked    @endif><lable>View Roles</lable></div>
              
                  
               
                  <div class="task"><input type="checkbox"  name="role_add" value="2"     @if($row->role_add==2)checked   @endif><lable>Add Roles</lable></div>
                
                
                  <div class="task"><input type="checkbox"  name="role_edit" value="2"    @if($row->role_edit==2)checked       @endif><lable>Edit Roles</lable></div>
                  
                    <div class="task"><input  type="checkbox"  name="role_delete" value="2"  @if($row->role_delete==2)checked       @endif><lable  >Delete Roles</lable></div>
         </td>
                    </tr>
                  
                    <tr>   <td>Skills</td>  
                    <td>
                   
                  <div class="task"><input type="checkbox"  name="view_skill" value="2"@if($row->view_skill==2) checked    @endif><lable>View Skills</lable></div>
              
                  
               
                  <div class="task"><input type="checkbox"  name="add_skill" value="2"     @if($row->add_skill==2)checked   @endif><lable>Add Skills</lable></div>
                
                
                  <div class="task"><input type="checkbox"  name="delete_skill" value="2"    @if($row->delete_skill==2)checked       @endif><lable>Delete Skills</lable></div>
         </td>
                    </tr>
                     <tr>   <td>Internship</td>  
                    <td>
                   
                  <div class="task"><input type="checkbox"  name="view_internship" value="2"@if($row->view_internship==2) checked    @endif><lable>View Internship</lable></div>
              
                  
               
                  <div class="task"><input type="checkbox"  name="add_internship" value="2"     @if($row->add_internship==2)checked   @endif><lable>Add Internship</lable></div>
                
                
                  <div class="task"><input type="checkbox"  name="edit_internship" value="2"    @if($row->edit_internship==2)checked       @endif><lable>Edit Internship</lable></div>
                  
                  <div class="task"><input type="checkbox"  name="delete_internship" value="2"    @if($row->delete_internship==2)checked @endif><lable>Delete Internship</lable></div>
         </td>
                    </tr>
                
             
                      <!--Location section-->
                           <tr>
                        <td>Location</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_location"   value="2" @if($row->view_location==2)checked @endif ><lable  >View Location</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_location"    value="2"  @if($row->add_location==2)checked @endif><lable  >Add Location</lable></div> 
                   
                  <div class="task"><input  type="checkbox"  name="delete_location" value="2"  @if($row->delete_location==2)checked @endif><lable  >Delete Location</lable></div>
                    
                    </td></tr>

<!--job section-->
                      <tr>
                        <td>Job</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_job"   value="2" @if($row->view_job==2)checked @endif><lable  >View Job</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_job"    value="2" @if($row->add_job==2)checked @endif><lable  >Add Job</lable></div> 
                    <div class="task"><input  type="checkbox"  name="edit_job"    value="2" @if($row->edit_job==2)checked @endif><lable  >Edit Job</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_job" value="2" @if($row->delete_job==2)checked @endif><lable  >Delete Job</lable></div>
                    
                    </td></tr>
                    
           <!--employee section-->
                    <tr>
                        <td>Employee</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_employee"   value="2" @if($row->view_employee==2)checked @endif><lable  >View Employee</lable></div>
                 
                  <div class="task"><input  type="checkbox"  name="delete_employee" value="2" @if($row->delete_employee==2)checked @endif><lable  >Delete Employee</lable></div>
                    
                    </td></tr>
                    <!--employer section-->
                    <tr>
                        <td>Employer</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_employer" value="2"  @if($row->view_employer==2)checked @endif><lable>View Employer</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_employer"    value="2"  @if($row->add_employer==2)checked @endif><lable  >Add Employer</lable></div> 
                    <div class="task"><input  type="checkbox" name="edit_employer" value="2"  @if($row->edit_employer==2)checked @endif><lable  >Edit Employer</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_employer" value="2"  @if($row->delete_employer==2)checked @endif><lable  >Delete Employer</lable></div>
                    
                    </td></tr>
                          
                          
                          <!--Story section-->
                      <tr>
                        <td>Stories</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_story"   value="2"  @if($row->view_story==2)checked @endif><lable  >View Stories</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_story"    value="2"  @if($row->add_story==2)checked @endif><lable  >Add Stories</lable></div> 
                    <div class="task"><input  type="checkbox"  name="edit_story"    value="2"  @if($row->edit_story==2)checked @endif><lable  >Edit Stories</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_story" value="2"  @if($row->delete_story==2)checked @endif><lable  >Delete Stories</lable></div>
                    
                    </td></tr>
                  
            <!---->
               <tr>
                        <td>Category</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="cat_show"   value="2" @if($row->cat_show==2)checked @endif><lable  >View Category</lable></div>
                  <div class="task"><input  type="checkbox"  name="cat_add"    value="2" @if($row->cat_add==2)checked @endif><lable  >Add Category</lable></div> 
                  <div class="task"><input  type="checkbox"  name="cat_delete" value="2" @if($row->cat_delete==2)checked @endif><lable  >Delete Category</lable></div>
                    
                    </td></tr>
                    <!---->
                        <tr>
                        <td>Company</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="camp_show"   value="2" @if($row->camp_show==2)checked @endif><lable  >View Company </lable></div>
                  <div class="task"><input  type="checkbox"  name="camp_add"    value="2" @if($row->camp_add==2)checked @endif><lable  >Add Company</lable></div> 
                  <div class="task"><input  type="checkbox"  name="camp_delete" value="2" @if($row->camp_delete==2)checked @endif><lable  >Delete Company</lable></div>
                    
                    </td></tr>
                    <!---->
                       <tr>
                        <td>FAQ</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="faq_show"   value="2"  @if($row->faq_show==2)checked @endif><lable  >View FAQ </lable></div>
                  <div class="task"><input  type="checkbox"  name="faq_add"    value="2"  @if($row->faq_add==2)checked @endif><lable  >Add FAQ</lable></div> 
                  <div class="task"><input  type="checkbox"  name="faq_delete" value="2"  @if($row->faq_delete==2)checked @endif><lable  >Delete FAQ</lable></div>
                    
                    </td></tr>
                    <!---->
                        <tr>
                        <td>Upgrade Plan</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="up_plan_show"   value="2" @if($row->up_plan_show==2)checked @endif><lable  >View Upgrade Plan </lable></div>
                  <div class="task"><input  type="checkbox"  name="up_plan_add"    value="2" @if($row->up_plan_add==2)checked @endif><lable  >Add Upgrade Plan</lable></div> 
                  <div class="task"><input  type="checkbox"  name="up_plan_edit" value="2" @if($row->up_plan_edit==2)checked @endif><lable  >Edit Upgrade Plan</lable></div>
                  <div class="task"><input  type="checkbox"  name="up_plan_delete" value="2" @if($row->up_plan_delete==2)checked @endif><lable  >Delete Upgrade Plan</lable></div>
                    
                    </td></tr>
                    
   <tr<tr>
                        <td>Blog</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="bolg_show"   value="2"  @if($row->bolg_show==2)checked @endif><lable  >View Blog</lable></div>
                  <div class="task"><input  type="checkbox"  name="blog_add"    value="2"  @if($row->blog_add==2)checked @endif><lable  >Add Blog</lable></div> 
                  <div class="task"><input  type="checkbox"  name="blog_edit"   value="2"  @if($row->blog_edit==2)checked @endif> <lable >Edit Blog</lable></div> 
                  <div class="task"><input  type="checkbox"  name="blog_delete" value="2"  @if($row->blog_delete==2)checked @endif><lable  >Delete Blog</lable></div>
                    
                    </td></tr>

               <tr>
                        <td>Blog Category</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="cat_bolg_show"   value="2"  @if($row->cat_bolg_show==2)checked @endif ><lable  >View Blog Category</lable></div>
                  <div class="task"><input  type="checkbox"  name="cat_blog_add"    value="2"  @if($row->cat_blog_add==2)checked @endif ><lable  >Add Blog Category</lable></div> 

                  <div class="task"><input  type="checkbox"  name="cat_blog_delete" value="2"  @if($row->cat_blog_delete==2)checked @endif ><lable  >Delete Blog Category</lable></div>
                    
                    </td></tr>

                   
           
                          </table>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                  <button type="submit" class="btn btn-primary me-2 add_role_button">Update</button>
                              </div>
                             
                             
               </form>


                         
                        </div>   
                    
                     </div>
                        </div>
                 
                     
                                            <script>
    document.addEventListener("DOMContentLoaded", function () {
        const nameInput = document.getElementById("UrunID");
        const nameErrorSpan = document.getElementById("nameError");

        nameInput.addEventListener("input", function () {
            const name = nameInput.value;
            const isValid = "[A-Za-z\s\-]+".test(name);

            if (!isValid) {
                nameErrorSpan.innerHTML = "Please enter only alphabetical characters.";
                nameErrorSpan.style.color = "red";
            } else {
                nameErrorSpan.innerHTML = "";
            }
        });
    });
</script>
                     @endsection