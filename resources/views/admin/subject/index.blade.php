@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                            <div class="page-header-title">
                                <h5 class="m-b-10">Subjects</h5>
                            </div>
                        
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
                            <h5>Add Subjects</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('subject.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <?php
                                $classes = DB::table('categories')->get();
                                ?>

                                <div class="form-group">
                                        <label class="floating-label" for="Email">Select Class</label>
                                        <select name="class_id" class="form-control" id="">
                                            <option value="">--Select Class--</option>
                                            @foreach($classes as $temp)
                                            <option value="{{$temp->id}}">{{$temp->name}}</option>
                                            @endforeach
                                        </select>
                                          <span class="text-danger" id="nameError">
                              @error('class_id')
                              {{$message}}
                         
                            @enderror
                            </span>
                                    </div>
                             <div class="form-group">
                                        <label class="floating-label" for="Email">Subject Name</label>
                                        <input type="text" class="form-control" name="subject_name" id="nameInput" aria-describedby="emailHelp" required>
                                          <span class="text-danger" id="nameError">
                              @error('subject_name')
                              {{$message}}
                         
                            @enderror
                            </span>
                                    </div>
                               
                                <button type="submit" class="btn  btn-primary">Submit</button>

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
                            <h5>Subjects</h5>
                            {{--  <span class="d-block m-t-5">use class <code>table-striped</code> inside table element</span>  --}}
                        </div>
                          @if($user->is_admin==1||$permission!=null)
                            @if($user->is_admin==1||$permission->view_skill==2)
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S N.</th>
                                            <th>Class Name</th>
                                            <th>Subject Name</th>
                                         
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($location as $key => $value)
                                            <tr>
                                               <th scope="row">{{$location->firstItem() + $key }}</th>
                                               <td>{{ $value->category_name }}</td>
                                                <td>{{ $value->subject_name }}</td>
                                                
                                                 
                                                <td>
                                                    <form action="{{ route('subject.destroy', $value->id) }}" method="POST">
                                                        @csrf
                                                        @method('Delete')
                                                        <button class="btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                              
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                                  <div class="d-flex justify-content-center" style="margin-left: auto;">
                {{ $location->links() }}
            </div>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                <!-- [ form-element ] end -->
            </div>

        </div>
    </section>
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById("nameInput");
    const nameError = document.getElementById("nameError");
    
    nameInput.addEventListener("input", function () {
        const name = nameInput.value;
        const isValid = /[A-Za-z\s\-]+/.test(name);

        if (!isValid) {
            nameError.innerHTML = "The skill format is invalid..";
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
