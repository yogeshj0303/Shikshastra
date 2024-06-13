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
                                <h5 class="m-b-10">Role</h5>
                            </div>
                  
                        </div>
                    </div>
                </div>
            </div>  
                                        
                   
<form action="{{route('addrole.store')}}" method="post" enctype="multipart/form-data">
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
                                 <div class="col-12">
                        <div class="form-group row top_row">
                          <label class=" col-form-label">Role Name</label>
                          <div class="role_input">
                        <input class="from-group" type="text"name="name"placeholder="Enter new role name" id="Text" pattern="[A-Za-z\s\-]+" required/>
                           <div class="text-danger" id="nameError"></div>
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
                   <td>  <div class="task"><input type="checkbox"  name="dash_show" value="2"><lable >view</lable></div>
                    
                    </td>
                    </tr>
                        
             
                    
            
                 

                 

                
                  <!--  <tr>-->
                  <!--  <td>Employee</td>  -->
                  <!--  <td>-->
                  <!--<div class="task"><input  type="checkbox"  name="employee_show"   value="2"><lable  >View Employee</lable></div>-->
                  <!--<div class="task"><input  type="checkbox"  name="employee_add"    value="2"><lable  >Add Employee</lable></div> -->
                  <!--<div class="task"><input  type="checkbox"  name="employee_edit"   value="2"> <lable >Edit Employee</lable></div> -->
                  <!--<div class="task"><input  type="checkbox"  name="employee_delete" value="2"><lable  >Delete Employee</lable></div>-->
                    
                  <!--  </td></tr>-->
                
                    <tr>
                        <td>Roles</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="role_show"   value="2"><lable  >View Roles</lable></div>
                  <div class="task"><input  type="checkbox"  name="role_add"    value="2"><lable  >Add Roles</lable></div> 
                  <div class="task"><input  type="checkbox"  name="role_edit"   value="2"> <lable >Edit Roles</lable></div> 
                  <div class="task"><input  type="checkbox"  name="role_delete" value="2"><lable  >Delete Roles</lable></div>
                    
                    </td></tr>
                  
                      <tr>
                        <td>Skills</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_skill"   value="2"><lable  >View Skills</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_skill"    value="2"><lable  >Add Skills</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_skill" value="2"><lable  >Delete Skills</lable></div>
                    
                    </td></tr>
                      <tr>
                        <td>Internship</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_internship"   value="2"><lable  >View Internship</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_internship"    value="2"><lable  >Add Internship</lable></div> 
                    <div class="task"><input  type="checkbox"  name="edit_internship"    value="2"><lable  >Edit Internship</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_internship" value="2"><lable  >Delete Internship</lable></div>
                    
                    </td></tr>
                    <!--Location section-->
                           <tr>
                        <td>Location</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_location"   value="2"><lable  >View Location</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_location"    value="2"><lable  >Add Location</lable></div> 
                   
                  <div class="task"><input  type="checkbox"  name="delete_location" value="2"><lable  >Delete Location</lable></div>
                    
                    </td></tr>

<!--job section-->
                      <tr>
                        <td>Job</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_job"   value="2"><lable  >View Job</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_job"    value="2"><lable  >Add Job</lable></div> 
                    <div class="task"><input  type="checkbox"  name="edit_job"    value="2"><lable  >Edit Job</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_job" value="2"><lable  >Delete Job</lable></div>
                    
                    </td></tr>
                    
           <!--employee section-->
                    <tr>
                        <td>User</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_user"   value="2"><lable  >View User</lable></div>
                 
                  <div class="task"><input  type="checkbox"  name="delete_user" value="2"><lable  >Delete User</lable></div>
                    
                    </td></tr>
                    <!--employer section-->
                    <tr>
                        <td>Employer</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_employer" value="2"><lable>View Employer</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_employer"    value="2"><lable  >Add Employer</lable></div> 
                    <div class="task"><input  type="checkbox" name="edit_employer" value="2"><lable  >Edit Employer</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_employer" value="2"><lable  >Delete Employer</lable></div>
                    
                    </td></tr>
                    
                     <tr>
                        <td>Employee</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_employee" value="3"><lable>View Employee</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_employee"    value="3"><lable  >Add Employee</lable></div> 
                    <div class="task"><input  type="checkbox" name="edit_employee" value="3"><lable  >Edit Employee</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_employee" value="3"><lable  >Delete Employer</lable></div>
                    
                    </td></tr>
                          
                          
                          <!--Story section-->
                      <tr>
                        <td>Stories</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="view_story"   value="2"><lable  >View Stories</lable></div>
                  <div class="task"><input  type="checkbox"  name="add_story"    value="2"><lable  >Add Stories</lable></div> 
                    <div class="task"><input  type="checkbox"  name="edit_story"    value="2"><lable  >Edit Stories</lable></div> 
                  <div class="task"><input  type="checkbox"  name="delete_story" value="2"><lable  >Delete Stories</lable></div>
                    
                    </td></tr>
                    <!---->
                      <tr>
                        <td>Category</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="cat_show"   value="2"><lable  >View Category</lable></div>
                  <div class="task"><input  type="checkbox"  name="cat_add"    value="2"><lable  >Add Category</lable></div> 
                  <div class="task"><input  type="checkbox"  name="cat_delete" value="2"><lable  >Delete Category</lable></div>
                    
                    </td></tr>
                    <!---->
                        <tr>
                        <td>Company</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="camp_show"   value="2"><lable  >View Company </lable></div>
                  <div class="task"><input  type="checkbox"  name="camp_add"    value="2"><lable  >Add Company</lable></div> 
                  <div class="task"><input  type="checkbox"  name="camp_delete" value="2"><lable  >Delete Company</lable></div>
                    
                    </td></tr>
                    <!---->
                       <tr>
                        <td>FAQ</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="faq_show"   value="2"><lable  >View FAQ </lable></div>
                  <div class="task"><input  type="checkbox"  name="faq_add"    value="2"><lable  >Add FAQ</lable></div> 
                  <div class="task"><input  type="checkbox"  name="faq_delete" value="2"><lable  >Delete FAQ</lable></div>
                    
                    </td></tr>
                    <!---->
                        <tr>
                        <td>Upgrade Plan</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="up_plan_show"   value="2"><lable  >View Upgrade Plan </lable></div>
                  <div class="task"><input  type="checkbox"  name="up_plan_add"    value="2"><lable  >Add Upgrade Plan</lable></div> 
                  <div class="task"><input  type="checkbox"  name="up_plan_edit" value="2"><lable  >Edit Upgrade Plan</lable></div>
                  <div class="task"><input  type="checkbox"  name="up_plan_delete" value="2"><lable  >Delete Upgrade Plan</lable></div>
                    
                    </td></tr>
                    
                     
                    <tr>
                        <td>Blog</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="bolg_show"   value="2"><lable  >View Blog</lable></div>
                  <div class="task"><input  type="checkbox"  name="blog_add"    value="2"><lable  >Add Blog</lable></div> 
                  <div class="task"><input  type="checkbox"  name="blog_edit"   value="2"> <lable >Edit Blog</lable></div> 
                  <div class="task"><input  type="checkbox"  name="blog_delete" value="2"><lable  >Delete Blog</lable></div>
                    
                    </td></tr>
                    <tr>
                        <td>Blog Category</td>  
                    <td>
                  <div class="task"><input  type="checkbox"  name="cat_bolg_show"   value="2"  ><lable  >View Blog Category</lable></div>
                  <div class="task"><input  type="checkbox"  name="cat_blog_add"    value="2"  ><lable  >Add Blog Category</lable></div> 
            
                  <div class="task"><input  type="checkbox"  name="cat_blog_delete" value="2"  ><lable  >Delete Blog Category</lable></div>
                    
                    </td></tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                  <button type="submit" class="btn btn-primary me-2 add_role_button">Add Role</button>
                              </div>
                             
                             
               </form>


                         
                        </div>   
                    
                     </div>
                        </div>
                     
                         </section>
                         
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
                    