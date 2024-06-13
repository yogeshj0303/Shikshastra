@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
<style>
    .page-header-title {
        display: flex;
        justify-content: space-between;
    }
    .page-header-title a {
        padding: 5px 10px;
        background: #f38e27;
        color: #FFFFFF;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
<div class="pcoded-main-container">
        @if($user->is_admin==1||$permission!=null)
   
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                          <div class="page-header-title">
                                <h5 class="m-b-10">Review</h5>
                                       @if($user->is_admin==1||$permission->test_add==2) 
                                <a href="{{route('reviews.create')}}" class="button">Add +</a>
                                @endif
                            </div>
                   
                    </div>
                </div>
            </div>
        </div>
       @if($user->is_admin==1||$permission->test_show==2) 
        <div class="row">
           

                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Image</th>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                           @if($user->is_admin==1||$permission->test_delete==2) 
                          <th scope="col">Action</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($reviews as $key => $temp)
                        <tr>
                          <th>{{++$key}}</th>
                          <td>{{$temp->name}}</td>
                          <td><img src="{{ asset('uploads/images/'.$temp->image) }}" style="height: 50px; width:50px;"></td>
                          <td>{{$temp->date}}</td>
                           <td>{!!$temp->description!!}</td>
                          
                           @if($user->is_admin==1||$permission->test_delete==2) 
                                   <td>
                                        
                                         
                                          
                                           <a href="{{route('reviews.destroy',$temp->id)}}" >   <i class="fa fa-trash"></i></a>
                                       
                                                </td>
                                                @endif
                        
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
               
            
        </div>
        @endif
        <!-- [ Main Content ] end -->
    </div>
</div>
@endif
@endsection
