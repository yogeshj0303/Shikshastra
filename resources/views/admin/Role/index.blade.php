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

<section class="pcoded-main-container">
    <div class="pcoded-content">
          <h5 class="m-b-10">Role</h5>
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
                    <div class="card-header">
                         @if($user->is_admin==1||$permission!=null)
                            @if($user->is_admin==1||$permission->role_add ==2)
                              
                                <a href="{{ route('addrole.create') }}" ><button class="btn btn-primary">Add +</button></a>
                            @endif
                                @endif
                    </div>
                    <div class="card-body table-border-style">
                             @if($user->is_admin==1||$permission!=null)
                        @if($user->is_admin==1 || $permission->role_show==2)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S N.</th>
                                            <th>Name</th>
                                              @if($user->is_admin==1||$permission!=null)
                                            @if($user->is_admin==1 ||$permission->role_show==2 || $permission->role_edit==2 || $permission->role_delete==2)
                                                <th>Action</th>
                                            @endif
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->name }}</td>
                                                @if($user->is_admin==1||$permission!=null)
                                                @if($user->is_admin==1 || $permission->role_show==2 || $permission->role_edit==2 || $permission->role_delete==2)
                                                    <td>
                                                         @if($user->is_admin==1||$permission!=null)
                                                        @if($user->is_admin==1 || $permission->role_show==2)
                                                            <a href="view-permission/{{$value->id}}">
                                                                <button type="button" class="btn btn-dark btn-icon">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a>
                                                            @endif
                                                        @endif
                                                         @if($user->is_admin==1||$permission!=null)
                                                        @if($user->is_admin==1 || $permission->role_edit==2)
                                                            <a href="{{ route('addrole.edit', $value->id) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        @endif
                                                        @endif
                                                         @if($user->is_admin==1||$permission!=null)
                                                        @if($user->is_admin==1 || $permission->role_delete==2)
                                                            <a href="{{ route('addrole.delete', $value->id) }}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                        @endif
                                                    </td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
