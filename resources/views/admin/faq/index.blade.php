@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <section class="pcoded-main-container">
           @if($user->is_admin==1||$permission!=null)
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                            <div class="page-header-title">
                                <h5 class="m-b-10">Faq</h5>
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
                       @if($user->is_admin==1||$permission->faq_add==2) 
                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            <h5>Add FAQ</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('faq.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label class="floating-label" for="Email">Question</label>
                                    <input type="text" class="form-control" name="question" id="Email"
                                        aria-describedby="emailHelp" required>
                                        
                                         <span class="text-danger" id="nameError">
      @error('question')
                              {{$message}}
                         
                            @enderror
                            </span>
                                </div>
                                                             <div class="form-group">
    <label class="floating-label" for="Text">Answer</label>
    <textarea name="answer" id="form4Example3" required>{{ old('answer') }}</textarea>
</div>
                                <button type="submit" class="btn  btn-primary">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
                @endif
                <!-- [ form-element ] start -->
                  @if($user->is_admin==1||$permission->faq_show==2) 
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
                            <h5>FAQ</h5>
                            {{--  <span class="d-block m-t-5">use class <code>table-striped</code> inside table element</span>  --}}
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S N.</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                              @if($user->is_admin==1||$permission->faq_delete==2) 
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <th scope="row">{{$data->firstItem() + $key }}</th>
                                                <td>{{ $value->question }}</td>
                                                <td>{{ $value->answer }}</td>
                                                  @if($user->is_admin==1||$permission->faq_delete==2) 
                                                <td><a href="{{route('faq.edit',$value->id)}}"><button class="btn-info"><i class="fa fa-edit"></i></button></a>
                                                    <form action="{{ route('faq.destroy', $value->id) }}" method="POST">
                                                        @csrf
                                                        @method('Delete')
                                                        <button class="btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
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
        @endif
    </section>
    
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById("Email"); // Correct ID
    const nameErrorSpan = document.getElementById("nameError");

    nameInput.addEventListener("input", function () {
        const name = nameInput.value;
        const isValid = /[A-Za-z\s\-?]+/.test(name);

        if (!isValid) {
            nameErrorSpan.innerHTML = "The question format is invalid..";
            nameErrorSpan.style.color = "red";
        } else {
            nameErrorSpan.innerHTML = "";
        }
    });
});
</script>

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
@endsection
