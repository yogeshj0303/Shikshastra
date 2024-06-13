@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
<div class="pcoded-main-container">
    @if($user->is_admin==1||$permission!=null)
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">

                        <div class="page-header-title">
                            <h5 class="m-b-10">Class Category</h5>
                        </div>
                        {{--  <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Components</a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Elements</a></li>
                        </ul>  --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
             
                         
                            @if($user->is_admin==1||$permission->cat_add==2) 
            <div class="col-sm-6">
                <div class="card">

                    <div class="card-header">
                        <h5>Class Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                                    <div class="form-group">
                                        <label class="floating-label" for="Email">Category name</label>
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="nameInput" aria-describedby="emailHelp" required>
                                          <span class="text-danger" id="nameError">
      @error('name')
                              {{$message}}
                         
                            @enderror
                            </span>
                                    </div>
                                
                                   
                                    <button type="submit" class="btn  btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
            @endif
            <!-- [ form-element ] start -->
            @if($user->is_admin==1||$permission->cat_show==2) 
            <div class="col-sm-6">
                <div class="card">
                    @if (session()->has('Message'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('Message') }}
                    </div>

                @endif
                @if (session()->has('Error'))
                <div class="alert alert-danger" role="alert">
                    {{ session()->get('Error') }}
                </div>

            @endif
                    <div class="card-header">
                        <h5>Job Category</h5>
                        {{--  <span class="d-block m-t-5">use class <code>table-striped</code> inside table element</span>  --}}
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S N.</th>
                                        <th>Name</th>
                                        <!-- <th>Image</th> -->
                                          @if($user->is_admin==1||$permission->cat_delete==2) 
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $value)


                                    <tr>
                                         <th scope="row">{{$data->firstItem() + $key }}</th>
                                        <td>{{ $value->name }}</td>
                                      <!-- <td><img src="{{ asset('uploads/images/'.$value->image) }}" style="height: 50px; width:50px;"></td> -->
                                      @if($user->is_admin==1||$permission->cat_delete==2) 
                                     <td>
                 <a href="{{route('category.edit', $value->id) }}"   ><button class="btn-dark"><i class="fa fa-edit" ></i></button></a>
         <button class="btn-danger delete-button" type="button" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $value->id }}" data-name="{{ $value->name }}">
            <i class="fa fa-trash"></i>
        </button>
    
</td>
@endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                                  <div class="d-flex justify-content-center" style="margin-left: auto;">
                {{ $data->links() }}
            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- [ form-element ] end -->
        </div>

    </div>
    <!-- Modal HTML -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this category?</p>
                <p><strong>This action will also delete related:</strong></p>
                <ul>
                    <li>Jobs</li>
                    <li>Internships</li>
                    <li>Preferences</li>
                </ul>
                <p>If you delete this category, related jobs, internships, and preferences will also be deleted!</p>

                <!-- Hidden input fields for additional form data -->
                <input type="hidden" id="categoryToDeleteId" name="category_id">
                <input type="hidden" id="categoryToDeleteName" name="category_name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="confirmDeleteLink"> <!-- Use a placeholder for href -->
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </a>
            </div>
        </div>
    </div>
</div>

@endif
</div>
<script>
    // Function to handle the "Delete" button click
    function handleDeleteClick() {
        const categoryId = document.getElementById('categoryToDeleteId').value;
        const categoryName = document.getElementById('categoryToDeleteName').value;
        const deleteLink = document.getElementById('confirmDeleteLink');
        
        // Update the href attribute with the category ID
        deleteLink.href = "/category-delete/" + categoryId;
        
        // Show the modal
        $('#confirmDeleteModal').modal('show');
    }

    // Attach click event handlers to "Delete" buttons in the list
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const categoryId = button.getAttribute('data-id');
            const categoryName = button.getAttribute('data-name');
            
            // Set hidden input values
            document.getElementById('categoryToDeleteId').value = categoryId;
            document.getElementById('categoryToDeleteName').value = categoryName;
            
            // Handle the "Delete" button click
            handleDeleteClick();
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
@endsection
