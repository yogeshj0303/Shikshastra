@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
   <section class="pcoded-main-container">
         @if($user->is_admin==1)
                         
                          
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Top Category</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
               <div class="row">
                     @if($user->is_admin==1)
                <div class="col-sm-6">
                      <form action="{{ route('category.update',$company->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5>Job Category</h5>
                        </div>
                         <div class="card-body">
                                        <label class="floating-label" for="Email">Category name</label>
                                        <input type="text" class="form-control" value="{{$company->name}}" name="name"  required>
                                          <span class="text-danger" id="nameError">
      @error('name')
                              {{$message}}
                         
                            @enderror
                            </span>
                                    </div>
 
                          
                                <button type="submit" class="btn btn-primary">Submit</button>
                    
                        </div>
                    </div>
                    </form>
                </div>
               @endif
                    
                <!-- [ form-element ] end -->
            </div>

        </div>
    </section>
    @endif
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoInput = document.getElementById('form4Example2');
        const imagePreview = document.getElementById('image-preview');

        logoInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                // If no file selected, clear the image preview
                imagePreview.src = "{{ asset('uploads/images/'.$company->logo) }}";
            }
        });
    });
</script>

@endsection
