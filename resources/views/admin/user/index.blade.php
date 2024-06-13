
@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
<!-- DataTables -->
  
<style>    /* Reduce the width of the vertical scrollbar on the right side */
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
}</style>
<div class="pcoded-main-container">
    <div class="pcoded-content">
          <h5 class="m-b-10">All Users</h5>
        <!-- [ breadcrumb ] start -->
       
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">

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
            <!-- table card-1 start -->
  @if($user->is_admin==1||$permission!=null)
                         
                            @if($user->is_admin==1||$permission->view_user==2) 
                 <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped"  >
                                    <thead>
                                        
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <!--<th scope="col">Skils</th>-->
                          <th scope="col">Phone Number</th>
                          <th scope="col">Date</th>
                          <th scope="col">Time</th>
                             @if($user->is_admin==1||$permission->delete_user==2) 
                          <th scope="col">Action</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($emp as $key => $temp)
                          <?php
                          	$createdDate = Carbon\Carbon::parse($temp->created_at)->format("j F Y");
                            $createdTm = Carbon\Carbon::parse($temp->created_at)->format(" g:i A");

                          ?>
                        <tr>
                          <th scope="row">{{$emp->firstItem() + $key }}</th>
                          <td>{{$temp->fname}} &nbsp; {{$temp->lname}}</td>
                           <td>{{$temp->email}}</td>
                          <td>{{$temp->phone_number}}</td>
                             <td>{{$createdDate}}</td>
                                <td>{{$createdTm}}</td>
                          
                         <td>
                              <a href="{{route('user-view',$temp->id)}}">
                                                                <button type="button" class="btn btn-dark btn-icon">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a>
                             <a href="{{route('user.edit',$temp->id)}}" > <i class="fa fa-edit"></i></a>
                                                    <!--<form action="{{ route('user-delete', $temp->id) }}" method="Get">-->
                                                    <!--    @csrf-->
                                                    <!--    @method('Delete')-->
                                                    <!--    <button class="btn-danger">-->
                                                           <a href="user-delete/{{$temp->id}}" <i class="fa fa-trash" onclick="return confirm('Are you sure you want to delete this user?');"></i>
                                                    <!--        </button>-->
                                                    <!--</form>-->
                                                </td>
                                            
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    
                     
                           </div>
             
                     
                    

           <!-- Pagination Links -->
            <div class="d-flex justify-content-center" style="margin-left: auto;">
                {{ $emp->links() }}
            </div>
               @endif
            @endif
        </div> </div>   </div>

            </div>
              </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

  
  
 

<!-- Bootstrap 4 -->
<!--<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>-->
<!-- DataTables  & Plugins -->

<!--<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>-->


@endsection
