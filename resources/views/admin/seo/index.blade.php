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

                            <!--<div class="page-header-title">-->
                            <!--    <h5 class="m-b-10">Review</h5>-->
                            <!--</div>-->
                         
                        </div>
                    </div>
                </div>
            </div>

       
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <h5>Add SEO </h5>
                        </div>
                      
                        <div class="card-body">
                            <form action="{{ route('seo.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                        <label class="floating-label" for="Email">Select Page</label>
                        <select name="page_name" id="" class="form-control">
                            <option value="">--Select Page--</option>
                            <option value="home">Home</option>
                            <option value="about-us">About Us</option>
                            <option value="subject">Subjects</option>
                            <option value="chapter">Chapter</option>
                            <option value="chapter-details">Chapter Details</option>
                            <option value="contact-us">Contact Us</option>
                            <option value="blogs">Blogs</option>
                            <option value="gallery">Gallery</option>
                        </select>
                        @error('page_name')
                              {{$message}}
                         
                            @enderror
                            </span>
                        </div>

                     <div class="form-group">
                        <label class="floating-label" for="Email">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" value="{{ $seo->meta_title }}"   required>
                        <span class="text-danger" id="nameError">
                        @error('meta_title')
                              {{$message}}
                         
                            @enderror
                            </span>
                        </div>
                        
                        <div class="form-group">
                        <label class="floating-label" for="Email">Meta Keywords</label>
                        <input type="text" class="form-control" name="meta_keyword" value="{{ $seo->meta_keyword }}"   required>
                      
                        @error('meta_keyword')
                              {{$message}}
                         
                            @enderror
                            </span>
                        </div>

                        <div class="form-group">
                        <label class="floating-label" for="Email">Meta Description</label>
                        <input type="text" class="form-control" name="meta_desc" value="{{ $seo->meta_desc }}"   required>
                     
                        @error('meta_desc')
                              {{$message}}
                         
                            @enderror
                            </span>
                        </div>
                           
                                <button type="submit" class="btn  btn-primary">Submit</button>

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
    const nameInput = document.getElementById("nameInput");
    const nameError = document.getElementById("nameError");
    
    nameInput.addEventListener("input", function () {
        const name = nameInput.value;
        const isValid = /[A-Za-z\s\-]+/.test(name);

        if (!isValid) {
            nameError.innerHTML = "The name format is invalid..";
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


const descriptionInput = document.getElementById("form4Example3");
const descriptionError = document.getElementById("descriptionError");

descriptionInput.addEventListener("input", function () {
    console.log("Description input changed"); // Debugging statement

    const description = descriptionInput.value;

    if (description.trim() === "") {
        descriptionError.innerHTML = "The description field is required.";
    } else {
        descriptionError.innerHTML = ""; // Clear the error message
    }
});


</script>


