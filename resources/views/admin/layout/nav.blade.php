<style>
    .pcoded-navbar .navbar-content, .pcoded-navbar .navbar-wrapper {
        background: #FFFFFF !important;
    }
    .pcoded-navbar .pcoded-inner-navbar li > a > .pcoded-micon + .pcoded-mtext {
        color: #000000;
    }
    .pcoded-navbar .pcoded-inner-navbar li > a > .pcoded-micon i {
        color: #000;
    }
    .feather {
        color: #000 !important;
    }


  .container {
    flex: 1;
    overflow-y: auto; /* Allow content to scroll if it exceeds the viewport height */
  }

  .main-footer {
    background-color: #f8f8f8;
    text-align: center;
    padding: 10px;
    position: fixed; /* Set the position to fixed */
    bottom: 0; /* Position it at the bottom of the viewport */
    width: 100%;
  }
</style>


<nav class="pcoded-navbar">
        
<div class="container" >
     <!-- footer content -->
         <footer class="main-footer text-center" >
   <p style="color: black;"> <strong>Copyright &copy; 2023 <a href="https://acttconnect.com/" style="color: #f38e27;">ACT T Connect</a>.</strong>
    All rights reserved.
 </p>
  </footer>
        <!-- /footer content -->
        </div>
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div ps ps--active-y">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{ asset('backend/assets/images/user/avatar-2.jpg') }}"
                        alt="User-Profile-Image">
                    <div class="user-details">
                        <span>Act-T-Connect</span>
                        <div id="more-details"><p><span class="online_animation"></span></p></div>
                    </div>
                   
                </div>
           
            </div>

            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item text-warning pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                
                 <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tasks" aria-hidden="true"></i></span><span class="pcoded-mtext">Dashboard</span></a>

                </li>
                  
                   <li class="nav-item">
                    <a href="{{route('category.index')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-tasks" aria-hidden="true"></i></span><span class="pcoded-mtext">Class Category</span></a>

                    </li>

              
                    <li class="nav-item">
                    <a href="{{route('subject.index')}}" class="nav-link "><span class="pcoded-micon"> <i class="fa fa-paw text-c-red mb-1 d-block"></i></span> <span class="pcoded-mtext">Subjects</span></a>

                </li>

                <li class="nav-item">
                    <a href="{{route('chapter.index')}}" class="nav-link "><span class="pcoded-micon"> <i class="fa fa-paw text-c-red mb-1 d-block"></i></span> <span class="pcoded-mtext">Chapters</span></a>

                </li>
                
        
                  <li class="nav-item">
                    <a href="{{route('notes.index')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-graduation-cap"></i></span><span class="pcoded-mtext">Notes</span></a>
                               
                </li>
                 <li class="nav-item">
                    <a href="{{route('sample-paper.index')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-chalkboard-teacher"></i>
                    </span><span class="pcoded-mtext">Sample Papper</span></a>
                               

                </li>

               
                    <li class="nav-item">
                    <a href="{{route('back-gallery.index')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-picture-o"></i></span><span class="pcoded-mtext">Gallery</span></a>

                </li>
              
                   <li class="nav-item">
                    <a href="{{url('enquiry')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-folder"></i></span><span class="pcoded-mtext">Enquiry</span></a>

                </li>
                   <li class="nav-item">
                    <a href="{{route('faq.index')}}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-question-circle"></i></span><span class="pcoded-mtext">FAQ</span></a>

                </li>
               
                  <li class="nav-item">
                    <a href="{{route('seo.index')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-money"></i>
                      </span><span class="pcoded-mtext">SEO Management</span></a>

                </li>

                <li class="nav-item">
                    <a href="{{route('blog.index')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-money"></i>
                      </span><span class="pcoded-mtext">Blogs</span></a>

                </li>
               
                  
               
            </ul>



        </div>
    </div>

</nav>
