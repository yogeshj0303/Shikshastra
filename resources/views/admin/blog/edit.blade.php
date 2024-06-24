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
   <?php
   $new=Session::get('adminId');
   $admin=DB::table('admins')->where('id',$new)->first();
   ?>
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                            <div class="page-header-title">
                                <h5 class="m-b-10">Blog</h5>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <h5>Update Blog</h5>
                        </div>
                      
                        <div class="card-body">
                            <form action="{{route('blog.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
<input type="hidden" class="form-control" name="upload_user_id" value="{{ $admin->id }}" >
    
                                          <div class="form-group">
    <label class="floating-label" for="nameInput">Title</label>
    <input type="text" class="form-control" name="title" value="{{ $data->title }}"  id="nameInput" required>
    <span class="text-danger" id="nameError">
      @error('title')
                              {{$message}}
                         
                            @enderror
                            </span>
</div>

                                
   <div class="col-6 form-floating mb-3">
    <div class="form-group">
        <label class="floating-label" for="image">Image</label>
        <img src="{{asset('uploads/blog/'.$data->image)}}" alt="noimg"/>
        <input type="file" id="imageInput" name="image" class="form-control" accept="image/*" >
        
        <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
        <span class="text-danger">
            @error('image')
                {{$message}}
            @enderror
        </span>
    </div>
</div>
                        
                            
                               
                          
                                
                                  <div class="form-group">
    <label class="floating-label" for="Text">Description</label>
    <textarea name="description" id="form4Example3">{!! $data->description !!}</textarea>
    <span class="text-danger" id="descriptionError">
        @error('description')
            {{ $message }}no
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
    $(document).ready(function () {
        $('#imageInput').on('change', function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview')
                        .attr('src', e.target.result)
                        .css('display', 'block');
                };
                reader.readAsDataURL(file);
            } else {
                $('#imagePreview').css('display', 'none');
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
        const title = nameInput.value;
        const isValid = /[A-Za-z\s\-]+/.test(title);

        if (!isValid) {
            nameError.innerHTML = "The title format is invalid..";
        } else {
            nameError.innerHTML = ""; // Clear the error message
        }
    });

    
});





</script>

