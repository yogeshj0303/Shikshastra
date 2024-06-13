@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
<style>

    /* Reduce the width of the vertical scrollbar on the right side */
::-webkit-scrollbar {
    width: 4px; /* Width of vertical scrollbar */
    height: 4px; /* Height of horizontal scrollbar */
}

/* Style the vertical scrollbar track (the background) */
::-webkit-scrollbar-track {
    background-color: #f1f1f1;
}

/* Style the vertical scrollbar thumb (the draggable part) */
::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 4px;
}

/* Reduce the width of the horizontal scrollbar on the bottom */
::-webkit-scrollbar-thumb:horizontal {
    width: 8px;
}

/* Style the horizontal scrollbar track (the background) */
::-webkit-scrollbar-track:horizontal {
    background-color: #f1f1f1;
}

/* Style the horizontal scrollbar thumb (the draggable part) */
::-webkit-scrollbar-thumb:horizontal {
    background-color: #888;
    border-radius: 4px;
}

</style>
    <section class="pcoded-main-container">
        <div class="pcoded-content">
             <h5 class="m-b-10">Job Post</h5>
            <!-- [ breadcrumb ] start -->
            <!--<div class="page-header">-->
            <!--    <div class="page-block">-->
            <!--        <div class="row align-items-center">-->
            <!--            <div class="col-md-12">-->

            <!--                <div class="page-header-title">-->
                               
            <!--                </div>-->
                           
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                         @if($user->is_admin==1||$permission!=null)
                         
                            @if($user->is_admin==1||$permission->add_job==2) 
                        <div class="" style="float:right;"><a href="{{ route('job_post_frm') }}">

                            <button class="btn btn-primary">Add Job Here...</button></a></div>
                            @endif
                            @endif
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
                        <!--<div class="card-header">-->
                        <!--    <h5>Company Listing</h5>-->
                           
                        <!--</div>-->
                         @if($user->is_admin==1||$permission!=null)
                            @if($user->is_admin==1||$permission->view_job==2)
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S N.</th>
                                            <th>Category name</th>
                                            <th>Job Title</th>
                                            <th>Job Type</th>
                                            <th>Post Date</th>
                                            <th>Experience</th>
                                            <th>Website</th>
                                            <th>Location</th>
                                            <th>Salary</th>
                                            <th>Skills</th>
                                            <th>No of openings</th>
                                             <th>Probation Salary</th>
                                             <th>Probation Duration</th>
                                             <th>Post Date/time</th>
                                            <th>About Job</th>
                                             @if($user->is_admin==1||$permission!=null)
                            @if($user->is_admin==1||$permission->edit_job==2||$permission->delete_job==2)
                                            <th>Action</th>
                                            @endif
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                            <tr>
                                              <th scope="row">{{$data->firstItem() + $key }}</th>
                                                <td>{{ $value->category_name }}</td>
                                                <td>{{ $value->job_title }}</td>
                                                <td>{{ $value->job_type }}</td>
                                                <td>{{ $value->post_date }}</td>
                                            
                                                <td>{{ $value->experience }}</td>
                                                <td>{{ $value->website }}</td>
                                                <td>{{ $value->location }}</td>
                                                <td>{{ $value->salary }}</td>
                                               <td>
                                         <div style="width:300px; height:150px; overflow:scroll;">{{ $value->skills }}</div>
                                                </td>
                                                <td>{{ $value->openings }}</td>
                                                 <td>{{ $value->probation_salary }}</td>
                                                    
                                               <td>{{ $value->probation_duration }}</td>
                                               <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d F Y, h:i A') }}</td>
                                                <td><div style="width:600px; height:150px; overflow:scroll;">{!! $value->about_job !!}</div></td>
                                                   @if($user->is_admin==1||$permission!=null)
                            @if($user->is_admin==1||$permission->edit_job==2||$permission->delete_job==2) 
                                               <td>
                                                  
                            @if($user->is_admin==1||$permission->edit_job==2) 
                                         <a href="{{route('job.edit',$value->id)}}" > <i class="fa fa-edit"></i></a>
                                         @endif
                                          
                            @if($user->is_admin==1||$permission->delete_job==2) 
                                           <a href="{{route('job.delete',$value->id)}}" >   <i class="fa fa-trash"></i></a>
                                       @endif
                                                </td>
                                                @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <div class="d-flex justify-content-center" style="margin-left: auto;">
                {{ $data->links() }}
            </div>
                        @endif
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
