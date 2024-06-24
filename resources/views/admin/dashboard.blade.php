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
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<?php
$classCount = DB::table("categories")->count();
$enquiryCount = DB::table("enquiries")->count();
$subjectCount = DB::table("subjects")->count(); 
$totalBlogsCount = DB::table("blogs")->count();
?>

        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->
            <div class="row">
                <div class="card flat-card">
                    <div class="row-table">
                  ) 
                        <div class="col-sm-6 card-body br">
                            <a href="">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa fa-user-tie text-c-green mb-1 d-block"></i>
                                </div>
                               
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{$classCount}}</h5>
                                    <span><b>Total Class</b></span>
                                </div>
                            </div>
                            </a>
                        </div>
                      
                        <div class="col-sm-6 card-body">
                              <a href="">
                            <div class="row">
                                <div class="col-sm-4">
                                        <i class="fa fa-users text-c-blue mb-1 d-block"></i>
                                    <!--<i class="fa fa-institution text-c-red mb-1 d-block"></i>-->
                                </div>
                              
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{$enquiryCount}}</h5>
                                    <span><b>Total Enquiry</b></span>
                                </div>
                                
                                
                                
                                
                            
                            </div>
                            </a>
                        </div>
                     
                    </div>
                    <div class="row-table">
                      
                        <div class="col-sm-6 card-body br">
                              <a href="">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa fa-sitemap text-c-green mb-1 d-block"></i>
                                    <!--<i class="fa fa-users text-c-blue mb-1 d-block"></i>-->
                                </div>
                            
                                <div class="col-sm-8 text-md-center">
                                    <h5>{{$subjectCount}} </h5>
                                    <span><b>Total Subjects</b></span>
                                </div>
                            
                               
                            </div>
                            </a>
                        </div>
                      
                          <div class="col-sm-6 card-body">
                              <a href="">
                            <div class="row">
                                <div class="col-sm-4">
                                        <i class="fa fa-sitemap text-c-blue mb-1 d-block"></i>
                                    <!--<i class="fa fa-institution text-c-red mb-1 d-block"></i>-->
                                </div>
                           
                                <div class="col-sm-8 text-md-center">
                                   <h5>{{$totalBlogsCount}}</h5>
                                   <span><b>Total Blogs</b></span>
                                </div>
                                
                                
                                
                                
                            
                            </div>
                            </a>
                        </div>
                     
                       
                    </div>
                </div>
               
                <!-- widget primary card end -->
            </div>
        
            <!-- Latest Customers start -->

            <!-- Latest Customers end -->
        </div>
      
        <!-- [ Main Content ] end -->
    </div>
</div>
<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


  
  
  
  
   <script>
    @if(Session::has('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>
@endsection

