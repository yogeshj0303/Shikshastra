@extends('admin.layout.layout')
@section('content')


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp

<style>
    {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

a{
    text-decoration: none;
    color: rgb(0, 149, 255);
    font-weight: bold;
}

.main{
    padding-bottom: 2rem;
}

.container2{
    width: 70%;
}

.label{
    margin-bottom: 10px;
    font-weight: bold;
    font-size: 1.1rem;
}

.formdiv{
    padding: 19px 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.flex{
    display: flex;
    gap: 50px;
    flex-wrap: wrap;
}

.main-container{
    width: 80%;
}

.steps{
    margin-bottom: 1rem;
}

label{
    font-size: 15px;
    font-weight: 600;
    color: #292929a2;
}

.form-check-label{
    font-weight: normal;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.flex2{
    display: flex;
    gap: 100px;
}

p{
    margin: 0;
}

.p1{
    font-size: 15px;
    font-weight: 500;
    color: gray;
    margin-bottom: 1rem;
}

.p2{
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 5px;
}

.p3{
    margin-bottom: 10px;
    font-size: 15px;
    color: rgb(77, 76, 76);
}

.formdiv2{
    background-color: whitesmoke;
}

.button-div{
    /* background-color: red; */
    text-align: center;
}

button{
    border: none;
    padding: 8px 10px;
    background-color: rgb(0, 200, 255);
    color: white;
    font-weight: bold;
    border-radius: 3px;
}


@media screen and (max-width: 425px) {
    .container2{
        width: 100%;
    }

    .formdiv{
        padding: 10px 20px;
    }

    .flex{
        gap: 10px;
    }

    .flex2{
        gap: 0px;
        flex-wrap: wrap;
    }

}
</style>

   <div class="main">
        @if($user->is_admin==1||$permission!=null)
                            @if($user->is_admin==1||$permission->add_internship==2)
        <h2 class="text-center my-5">Post Job</h2>

        <div class="container container2">
           
            <div class="steps">
                <div class="container main-container">
                    <!--<label for="" class="label">Job Title</label>-->
                    <div class="formdiv">
                        <form action="{{route('job.store')}}" method="post">
               @csrf
               
               <div class="mb-1">
    <label for="category" class="form-label">Category</label>
    <select name="category_id" class="form-select" >
        <option value="" >Select a category</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
      <span class="text-danger" >
    @error('category_id')
    {{ $message }}
    @enderror
       </span>
</div>
               
                <div class="mb-1">
    <label for="">Job Title</label>
    <div class="form-floating">
       <input type="text" name="job_title" class="form-control" value="{{old('job_title')}}"  id="nameInput" placeholder="Enter Job Title" >
    <span class="text-danger" id="nameError">
      @error('job_title')
                              {{$message}}
                         
                            @enderror
                            </span>
    </div>
</div>
              
                     
                            
<!--<div class="mb-1">-->
<!--    <label for="formGroupExampleInput" class="form-label">Posted Date</label>-->
<!--    <input type="date" name="post_date" class="form-control" value="{{ old('post_date') }}" id="start_from" placeholder="" >-->
<!--    <span id="startFromError" class="text-danger"></span>-->
<!--</div>-->


                       
                        <!-- Inside the form -->
                           <div class="my-2">
    <label for="">Job type</label>
    <div class="flex">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault4PartTime" value="Part Time"
                @if(old('job_type') == 'Part Time') checked @endif>
            <label class="form-check-label" for="flexRadioDefault4PartTime">
                Part Time
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault4FullTime" value="Full Time"
                @if(old('job_type') == 'Full Time') checked @endif>
            <label class="form-check-label" for="flexRadioDefault4FullTime">
                Full Time
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault4Remote" value="Remote"
                @if(old('job_type') == 'Remote') checked @endif>
            <label class="form-check-label" for="flexRadioDefault4Remote">
                Remote
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault3InOffice" value="In-office"
                @if(old('job_type') == 'In-office' || old('job_type') === null) checked @endif>
            <label class="form-check-label" for="flexRadioDefault3InOffice">
                In-office
            </label>
        </div>
    </div>
</div>
<!--<div class="my-2">-->
<!--    <label for="">Part-time/Full-time</label>-->
<!--    <div class="flex ">-->
<!--        <div class="form-check">-->
<!--            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault5" value="Part Time" >-->
<!--            <label class="form-check-label" for="flexRadioDefault5">-->
<!--                Part-time-->
<!--            </label>-->
<!--        </div>-->
<!--        <div class="form-check">-->
<!--            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault6" value="Full Time" checked>-->
<!--            <label class="form-check-label" for="flexRadioDefault6">-->
<!--                Full-time-->
<!--            </label>-->
<!--        </div>-->
        
<!--        <div class="form-check">-->
<!--            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault6" value="Remote" checked>-->
<!--            <label class="form-check-label" for="flexRadioDefault6">-->
<!--                Remote-->
<!--            </label>-->
<!--        </div>-->
<!--        <div class="form-check">-->
<!--            <input class="form-check-input" type="radio" name="job_type" id="flexRadioDefault6" value="In-office" checked>-->
<!--            <label class="form-check-label" for="flexRadioDefault6">-->
<!--                In-office-->
<!--            </label>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

                        <div class="mb-1">
                            <label for="formGroupExampleInput" class="form-label">Salary</label>
                            <input type="number" name="salary" value="{{old('salary')}}" class="form-control" id="salary_range}}" placeholder="Enter Salary"   oninput="this.value = this.value.replace(/[eE]/g, '')">

  <span class="text-danger" >
      @error('salary')
                              {{$message}}
                         
                            @enderror
                            </span>
                        </div>
                        
          <div class="mb-1">
    <label for="location" class="form-label">Location</label>
    <select name="location" class="form-control" id="location">
        <option value="">Select Location</option>
        @foreach($locations as $location)
            <option value="  {{ $location->location }}" {{ old('location', $location->location) == $location->id ? 'selected' : '' }}>
                {{ $location->location }}
            </option>
        @endforeach
    </select>
    @error('location')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

  <div class="mb-1">
    <label for="formGroupExampleInput" class="form-label">Last Date To Apply</label>
    <input type="date" name="last_date" value="{{ old('last_date') }}" class="form-control" id="dateInput" aria-describedby="dateError" placeholder="" >
  <span class="text-danger" id="dateError">
       @error('last_date')
                              {{$message}}
                         
                            @enderror
                            </span>
</div>

                        
                        
                       <div class="mb-1">
    <label for="salary_range" class="form-label">Experience (In Year)</label>
    <input type="number" name="experience" value="{{old('experience')}}" class="form-control" id="salary_range" placeholder="Enter Experience"   oninput="this.value = this.value.replace(/[eE]/g, '')">
    <span class="text-danger">
      @error('experience')
                              {{$message}}
                         
                            @enderror
                            </span>
</div>

<?php
$new=Session::get('adminId');
$wesite = DB::table('admins')->where('id',$new)->first();

?>
    <div class="mb-1">
    <label for="formGroupExampleInput" class="form-label">Company Website Link</label>
    <input type="text" name="website" class="form-control" value="{{$wesite->website}}" id="websiteInput"  placeholder="Enter Company Website" readonly >
    <span class="text-danger" id="websiteError">
       @error('website')
                              {{$message}}
                         
                            @enderror
                            </span>
</div>


<!--<div class="mb-1">-->
<!--    <label for="admin_website" class="form-label">Admin Website</label>-->
<!--    <select name="awebsite" class="form-select" id="admin_website">-->
<!--        <option value="">Select Admin Website</option>-->
<!--        @foreach ($adminWebsites as $adminId => $adminWebsite)-->
<!--            <option value="{{ $adminId }}">{{ $adminWebsite }}</option>-->
<!--        @endforeach-->
<!--    </select>-->
<!--</div>-->



           <div class="mb-1">
    <label for="location" class="form-label">About Job</label>
    <textarea name="about_job" class="form-control" placeholder="About Job" id="form4Example3"
                                    style="height: 100px" >{{old('about_job')}}</textarea>
                                    
                                     <span class="text-danger" >
       @error('about_job')
                              {{$message}}
                         
                            @enderror
                            </span>
</div>
            
 <div class="mb-3">
    <label for="selected_skills" class="form-label">Selected Skills</label>
    <div class="row">
        <div class="col">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Skills
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="skillDropdown">
                    @foreach ($skills as $skill)
                        <a class="dropdown-item skill-option" href="#" data-skill-id="{{ $skill->id }}">{{ $skill->skill }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col">
            <textarea name="selected_skills" class="form-control" id="selected_skills" rows="1" readonly></textarea>
        </div>
    </div>
    @error('selected_skills')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>  

 <div class="mb-1">
    <label for="">Probation Salary</label>
    <div class="form-floating">
        <input type="number" name="probation_salary" value="{{old('probation_salary')}}" class="form-control" id="salary_range" placeholder="Enter Probation Salary"  oninput="this.value = this.value.replace(/[eE]/g, '')">
         <span class="text-danger" >
      @error('probation_salary')
                              {{$message}}
                         
                            @enderror
                            </span>
    </div>
</div>    

 <div class="mb-1">
    <label for="">Probation Duration (In Months)</label>
    <div class="form-floating">
        <input type="number" name="probation_duration" value="{{old('probation_duration')}}" class="form-control" id="salary_range" placeholder="Enter Probation Duration"  oninput="this.value = this.value.replace(/[eE]/g, '')">
         <span class="text-danger" >
      @error('probation_duration')
                              {{$message}}
                         
                            @enderror
                            </span>
    </div>
</div>    


   <div class="mb-1">
    <label for="">Number of openings</label>
    <div class="form-floating">
        <input type="number" name="openings" value="{{old('openings')}}"  class="form-control" id="salary_range" placeholder="Enter Openings"  oninput="this.value = this.value.replace(/[eE]/g, '')">
            <span class="text-danger" >
      @error('openings')
                              {{$message}}
                         
                            @enderror
                            </span>
    </div>
</div> 

  




                       
                       
                    </div>

                </div>
            </div>
            
 


           
            

        </div>

        <div class="button-div">
            <button>Post Job</button>
        </div>
    </div>
    </form>
    </div>
    @endif
    @endif
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        const selectedSkills = new Set();
        const selectedSkillsInput = $('#selected_skills');

        // Handle click on skill options in the dropdown
        $('#skillDropdown').on('click', '.skill-option', function(event) {
            event.preventDefault();
            const skillId = $(this).data('skill-id');
            const skillName = $(this).text();

            if (!selectedSkills.has(skillId)) {
                selectedSkills.add(skillId);
                selectedSkillsInput.val([...selectedSkills].map(id => $('#skillDropdown').find(`[data-skill-id="${id}"]`).text()).join(', '));
            }
        });

        // Handle click on selected skills in the input field
        selectedSkillsInput.on('click', function(event) {
            event.preventDefault();
            const inputSkills = selectedSkillsInput.val().split(', ').map(skillName => {
                const skillId = [...selectedSkills].find(id => $('#skillDropdown').find(`[data-skill-id="${id}"]`).text() === skillName);
                return { id: skillId, name: skillName };
            });

            if (inputSkills.length > 0) {
                const skillIdToRemove = inputSkills[inputSkills.length - 1].id;
                selectedSkills.delete(skillIdToRemove);
                selectedSkillsInput.val([...selectedSkills].map(id => $('#skillDropdown').find(`[data-skill-id="${id}"]`).text()).join(', '));
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#form4Example3').summernote({
            height: 200, // Set the height of the editor
            // Add any other options you need
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById("nameInput");
const nameError = document.getElementById("nameError");

nameInput.addEventListener("input", function () {
    const name = nameInput.value;
    const isValid = /^[A-Za-z\s\-]+$/.test(name); // Allow only alphabetic characters, spaces, and hyphens

    if (!isValid) {
        nameError.innerHTML = "The job title format is invalid. Please use only alphabetic characters.";
        nameInput.value = name.replace(/[^A-Za-z\s\-]/g, ''); // Remove any non-alphabetic characters
    } else {
        nameError.innerHTML = ""; // Clear the error message
    }
});

    const dateInput = document.getElementById("dateInput");
    const dateError = document.getElementById("dateError");

    dateInput.addEventListener("input", function () {
        const selectedDate = new Date(dateInput.value);
        const currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0); // Set current date to midnight for accurate comparison

        if (selectedDate < currentDate) {
            dateError.innerHTML = "The date must be a date after or equal to today.";
        } else {
            dateError.innerHTML = ""; // Clear the error message
        }
    });
});



</script>

<script>
    // Prevent 'e' character in number input fields
    document.addEventListener("input", function (e) {
        if (e.target.type === "number") {
            e.target.value = e.target.value.replace(/[eE]/g, '');
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const websiteInput = document.getElementById("websiteInput"); // Update the ID here
        const websiteErrorSpan = document.getElementById("websiteError");

        websiteInput.addEventListener("blur", function () {
            const websiteValue = websiteInput.value;

            if (!/^www\..+/.test(websiteValue)) {
                websiteErrorSpan.innerHTML = "Please enter a website in the www. format.";
                websiteErrorSpan.style.color = "red";
            } else {
                websiteErrorSpan.innerHTML = "";
                websiteErrorSpan.style.color = ""; // Clear any previous error styles
            }
        });
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
    const skillInput = document.getElementById("skillInput");
    const skillErrorSpan = document.getElementById("skillError");

    skillInput.addEventListener("input", function () {
        const skill = skillInput.value;
        const isValid = /^[A-Za-z\s\-]+$/.test(skill);

        if (!isValid) {
        skillError.innerHTML = "The skill format is invalid. Please use only alphabetic characters.";
        skillInput.value = name.replace(/[^A-Za-z\s\-]/g, ''); // Remove any non-alphabetic characters
    } else {
        skillError.innerHTML = ""; // Clear the error message
    }
    });


});

</script>
