@extends('admin.layout.layout')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Change-password</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="">Change password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
         <div class="card-body">
                    <form id="" action="{{ route('change.password') }}" method="POST">
                        @csrf

                         @foreach ($errors->all() as $error)
                            <p class="text-danger" class="center">{{ $error }}</p>
                         @endforeach
                         @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
                         <h2>Please fill: <div id="successmessage" class="center"></div></h2>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                            <p class="text-danger" id="registercrntpsw"></p>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                            <p class="text-danger" id="registerpsw"></p>
                        </div>

                                         <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
                        <div class="col-md-6">
                            <input id="new_confirm_password" type="password" class="form-control" name="new_password_confirmation" required autocomplete="new-password">
                        </div>
                        <p class="text-danger" id="registercnfpsw"></p>
                    </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
    </div>
</div>
@endsection
