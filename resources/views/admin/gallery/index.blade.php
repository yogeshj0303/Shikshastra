@extends('admin.layout.layout')
@section('content')
@php

<div class="pcoded-main-container">

    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">

                        <div class="page-header-title">
                            <h5 class="m-b-10">Gallery Images</h5>
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

            <div class="col-sm-6">
                <div class="card">

                    <div class="card-header">
                        <h5>Gallery Image</h5>
                    </div>
                    <div class="card-body">
                        
                    <form action="{{ route('back-gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label class="floating-label" for="Email">Gallery Image</label>
        <input type="file" class="form-control" value="{{ old('image') }}" name="image" id="nameInput" aria-describedby="emailHelp" required>
        <span class="text-danger" id="nameError">
            @error('image')
                {{ $message }}
            @enderror
        </span>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
                    </div>
                </div>
            </div>

            <!-- [ form-element ] start -->
          
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
                        <h5>Gallery</h5>
                       </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S N.</th>
                                        <th>Image</th>
                                       <th>Action</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $value)


                                    <tr>
                                      <th scope="row">{{$data->firstItem() + $key }}</th>
                                        <td> <img src="{{ $value->image }}" alt="Gallery Image" width="100"></td>
                                          <td>
   
         <button class="btn-danger delete-button" type="button" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $value->id }}" data-name="{{ $value->image }}">
            <i class="fa fa-trash"></i>
        </button>
    
</td>

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
                    <li>Image</li>
                   
                </ul>
     
             
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

</div>
<script>
    // Function to handle the "Delete" button click
    function handleDeleteClick() {
        const categoryId = document.getElementById('categoryToDeleteId').value;
        const categoryName = document.getElementById('categoryToDeleteName').value;
        const deleteLink = document.getElementById('confirmDeleteLink');
        
        // Update the href attribute with the category ID
        
        deleteLink.href = "/blog-cat/" + categoryId;
        
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
