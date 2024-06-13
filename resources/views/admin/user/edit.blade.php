@extends('admin.layout.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<style>
    .card .card-header {
    border-bottom: 1px solid green;
    position: relative;
    background-color: #f38e27;
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
                                <h5 class="m-b-10"> User </h5>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>

       
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <h5>Edit User</h5>
                        </div>
                        
                        
                      
                        <div class="card-body">
                            <form action="{{ route('user.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
@method('PUT')
                      <div class="form-group">
                                    <label class="floating-label" for="fname">First Name</label>
                                    <input type="text" id="fname"class="form-control" name="fname" value="{{$data->fname}}" required/>
                                             <span class="text-danger" >
      @error('fname')
                              {{$message}}
                         
                            @enderror
                            </span> 
                                </div>
                                
                                 <div class="form-group">
                                    <label class="floating-label" for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" value="{{$data->lname}}" required/>
                                           <span class="text-danger" >
      @error('lname')
                              {{$message}}
                         
                            @enderror
                            </span>   
                                </div>
                                
                                   
            
                 <div class="form-group">
                                    <label class="floating-label" for="Email">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$data->email}}"  id="Email"
                                        aria-describedby="emailHelp" required/>
                                         <span class="text-danger" >
      @error('email')
                              {{$message}}
                         
                            @enderror
                            </span>    
                                </div>
                                
                      

                                
                                
                                     <div class="form-group">
                                    <label class="floating-label" for="phone">Phone</label>
                                    <input type="number" class="form-control" name="phone_number" value="{{$data->phone_number}}"  id="phone"
                                         required oninput="this.value = this.value.replace(/[eE]/g, '')">
                                                       <span class="text-danger" >
      @error('phone_number')
                              {{$message}}
                         
                            @enderror
                            </span> 
                                </div>
                                
                                     <div class="form-group">
                                    <label class="floating-label" for="form4Example3">About us</label>
                                    <textarea type="number" class="form-control" name="about_us"   id="form4Example3">{{$data->about_us}}</textarea>
                                               <span class="text-danger" >
      @error('about_us')
                              {{$message}}
                         
                            @enderror
                            </span> 
                                </div>
                         
                               <div class="form-group">
                                    <label class="floating-label" for="password">Password</label>
                                    <input type="password" id="password" class="form-control" name="password"  
                                        >
                                         <span class="text-danger" >
      @error('password')
                              {{$message}}
                         
                            @enderror
                            </span>  
                                </div>
                               
                          
  
                                
                                  
                                <button type="submit" class="btn  btn-primary">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
              
            </div>

        </div>
    </section>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


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
    const nameInput = document.getElementById("Email"); // Correct ID
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

<!-- Your existing HTML and JavaScript code -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dateInput = document.getElementById("Email"); // Change this to the actual input ID
        const dateErrorSpan = document.getElementById("dateError");

        dateInput.addEventListener("change", function () {
            const selectedDate = new Date(dateInput.value);
            const currentDate = new Date();

            if (selectedDate < currentDate) {
                dateErrorSpan.innerHTML = "Date must be today or a future date.";
                dateErrorSpan.style.color = "red";
            } else {
                dateErrorSpan.innerHTML = "";
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

