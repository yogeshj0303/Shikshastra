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
                                    <h5></h5>
                                    <span><b>Employer User</b></span>
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
                                    <h5></h5>
                                    <span><b>Registered User</b></span>
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
                                    <h5>10 </h5>
                                    <span><b>Jobs</b></span>
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
                                   <h5>10</h5>
                                   <span><b>Internships</b></span>
                                </div>
                                
                                
                                
                                
                            
                            </div>
                            </a>
                        </div>
                     
                       
                    </div>
                </div>
               
                <!-- widget primary card end -->
            </div>
              <div class="row">
                <div class="card flat-card">
                    <div class="row-table">
                      
                        <div class="col-sm-6 card-body br">
                             <a href="" >
                            <div class="row">
                                <div class="col-sm-4">
                                    
                                    <i class="fa fa-sitemap text-c-green mb-1 d-block"></i>
                                </div>
                              
                                <div class="col-sm-8 text-md-center">
                                    <h5>5</h5>
                                    <span><b>Job Category</b></span>
                                </div>
                            </div>
                            </a>
                        </div>
                            <div class="col-sm-6 card-body">
                              <a href="" >
                            <div class="row">
                                <div class="col-sm-4">
                                     <i class="fa fa-paper-plane text-c-yellow mb-1 d-block"></i>
                                    <!--<i class="fa fa-paw text-c-red mb-1 d-block"></i>-->
                                </div>
                               
                                
                                <div class="col-sm-8 text-md-center">
                                    <h5>25</h5>
                                    <span><b>Blogs</b></span>
                                </div>
                               
                            </div>
                            </a>
                        </div>
                        
                    </div>
                    <div class="row-table">
                    
                        <div class="col-sm-6 card-body br">
                             <a href="" >
                            <div class="row">
                                <div class="col-sm-4">
                                     <i class="fa fa-users text-c-blue mb-1 d-block"></i>
                                     <!--<i class="fa fa-briefcase text-c-blue mb-1 d-block"></i>-->
                                    
                                </div>
                               
                               
                                <div class="col-sm-8 text-md-center">
                                    <h5>85</h5>
                                    <span><b>Employees</b></span>
                                </div>
                               
                            </div>
                            </a>
                        </div>
                      
                        <div class="col-sm-6 card-body">
                              <a href="" >
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fas fa-signal text-c-yellow mb-1 d-block"></i>
                                </div>
                               
                                <div class="col-sm-8 text-md-center">
                                    <h5>55</h5>
                                    <span><b>Locations</b></span>
                                </div>
                            </div>
                            </a>
                        </div>
                      
                    </div>
                </div>
                <!-- widget primary card start -->
              
                <!-- widget primary card end -->
            </div>
            <!-- table card-1 end -->
           
            <!-- Widget primary-success card start -->
            {{--  <div class="col-md-12 col-xl-4">
                <div class="card support-bar overflow-hidden">
                    <div class="card-body pb-0">
                        <h2 class="m-0">350</h2>
                        <span class="text-c-blue">Support Requests</span>
                        <p class="mb-3 mt-3">Total number of support requests that come in.</p>
                    </div>
                    <div id="support-chart"></div>
                    <div class="card-footer bg-primary text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white">10</h4>
                                <span>Open</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">5</h4>
                                <span>Running</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white">3</h4>
                                <span>Solved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  --}}
            <!-- Widget primary-success card end -->



            <!-- seo end -->

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

