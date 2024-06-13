@extends('admin.layout.layout')
@section('content')

 <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- FontAwesome JS-->
	<script defer src="assets/fontawesome/js/all.min.js"></script>
    <!-- Global CSS -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/orbit-1.css">

<style>
  @media print {
    header, footer, .print_button {
        display: none;
    }
}
.fifth_section {
    padding-top: 90px;
}
    .print_button {
        position: absolute;
        top: 10px;
    }
    .print_button svg {
        fill: #ffffff;
    }
</style>
 @php
        $user = DB::table('users')->where('id',$data->id)->first();
       
    @endphp
        <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                            <div class="page-header-title">
                                <h5 class="m-b-10"> User </h5>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>
            <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Angelina Vincent | Health Instructor</title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/cv_seventh.css" />
    <style>
      @media print {
    header, footer, .print_button {
        display: none;
    }
}
    .award {
        padding-left: 0px !important;
        padding-top: 20px;
    }
    .print_button {
        position: relative;
        top: -30px;
        right: -30px;
    }
    .print_button svg {
        fill: #FFFFFF;
    }
    .print_div {
        width: 100%;
        display: flex;
        justify-content: end;
    }
        @media (max-width: 768px) {
            .print_button {
                 position: relative;
        top: -20px;
        right: 0px;
            }
            .overcover {
                padding-top: 90px;
            }
        }
        .pl {
            padding-left: 0px !important;
        }
    </style>
</head>

<body>
     @php
        $user = DB::table('users')->where('id',$data->id)->first();
       
    @endphp
    <div class="container-fluid overcover">
        <div class="profile-box">
            <div class="print_div" id="printButton">
                 <button class=" print_button">
        <svg class="print_svg" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
        Print
      </button>
            </div>
            <div class="title row">
                <h1>{{$user->fname}} {{$user->lname}}</h1>
                <p>
                             <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                </p>
                               <?php
                     
                    $data=DB::table('experiences')->where('user_id',$user->id)->latest()->take(1)->get();
                    
                    ?>
                    @foreach($data as $ex)
                <h6>{{$ex->designation}}</h6>
                @endforeach
            </div>
            <div class="details row">
                <div class="col-md-6">
                    <div class="about pr">
                        <h5>About</h5>
                        <p>{{$user->about_us}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                   <div class="contact pl">
                        <h5>Contact Details</h5>
                        <ul>
                            <li><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M347.1 24.6c7.7-18.6 28-28.5 47.4-23.2l88 24C499.9 30.2 512 46 512 64c0 247.4-200.6 448-448 448c-18 0-33.8-12.1-38.6-29.5l-24-88c-5.3-19.4 4.6-39.7 23.2-47.4l96-40c16.3-6.8 35.2-2.1 46.3 11.6L207.3 368c70.4-33.3 127.4-90.3 160.7-160.7L318.7 167c-13.7-11.2-18.4-30-11.6-46.3l40-96z"/></svg>{{$user->phone_number}}</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg> {{$user->email}}</li>
                                             </ul>
                    </div>
                </div>
            </div>
            <div class="details row">
                 <?php
                     
                    $data1=DB::table('experiences')->where('user_id',$user->id)->get();
                       use Carbon\Carbon;
                    ?>
                    @foreach($data1 as $ex)
                     @php
                   
                    $yearstart = Carbon::parse($ex->start_date)->format('j F Y');
                    $yearend = Carbon::parse($ex->end_date)->format('j F Y');
                    @endphp
                <div class="col-md-6">
                    <div class="experiance pr">
                        <h5>Experiance</h5>
                        <h6>{{$ex->designation}}</h6>
                        <p>{{$ex->organization}}({{$yearstart}} - {{$yearend}})</p>
                        <ul>
                            <li>{{$ex->description}}</li>
                            <!--<li>Curabitur non nibh augue. Nullam hendrerit massa nec ex </li>-->
                        </ul>
                    </div>
                </div>
                @endforeach
                <!--<div class="col-md-6">-->
                <!--    <div class="experiance pl">-->
                       
                      
                <!--        <h6 class="rt6">Fitnes Trainer</h6>-->
                <!--        <p>George Medicals(2013 - 2016)</p>-->
                <!--        <ul>-->
                <!--            <li>In ultrices porta libero, tincidunt vestibulum felis tincidunt nec.</li>-->
                <!--            <li>Curabitur non nibh augue. Nullam hendrerit massa nec ex </li>-->
                <!--        </ul>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
            <div class="details row">
                <div class="col-md-6">
                    <div class="qualification pr">
                        <h5>Qualifications</h5>
                        
                       <div class="award educa pl">
                           <?php
                 
                    $qual=DB::table('education')->where('user_id',$user->id)->get();
                
                    ?>
                    @foreach($qual as $qua)
                       @php
                   
                   $start = Carbon::parse($qua->start_date)->format(' Y');
                   $end = Carbon::parse($qua->end_date)->format(' Y');
                   @endphp
                        <div class="education_div">
                            <h6>{{$qua->degree}} </h6>
                        <p>{{$qua->stream}}
                            <br />
                          {{$qua->name}}
                        <br>
                        Percentage - {{$qua->percentage}}%
                        <br/>
                      {{$start}} - {{$end}}
                        </p>
                        
                        </div>
                        @endforeach
                        <div class="education_div">
                        <!--    <h6>Diploma</h6>-->
                        <!--<p>Information Technology-->
                        <!--<br />-->
                        <!--    Institute of Engineering & Technology, Agra-->
                        <!--<br>-->
                        <!--Percentage - 80%-->
                        <!--<br/>-->
                        <!--2019 - 2022-->
                        <!--</p>-->
                        <!--</div>-->
                        <!--<div class="education_div">-->
                        <!--    <h6>High School</h6>-->
                        <!--<p>Mathematics-->
                        <!--<br/>-->
                        <!--    Institute of Engineering & Technology, Agra-->
                        <!--<br>-->
                        <!--Percentage - 80%-->
                        <!--<br/>-->
                        <!--2019 - 2022-->
                        <!--</p>-->
                        <!--</div>-->
                    </div>
                        
                    </div>
                </div>
                <div class="col-md-6" style="padding: 0px !important;">
                    <div class="skill pl">
                        <h5>Skills</h5>
                        <ul>
                             <?php
                $skill=DB::table('qualities')->where('user_id',$user->id)->get();
             
                    ?>
                    @foreach($skill as $sk)
                            <li>{{$sk->skill}}</li>
                            @endforeach
                            <!--<li>HTML</li>-->
                            <!--<li>CSS</li>-->
                            <!--<li>JavaScript</li>-->
                            <!--<li>MySQL</li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="details mb-0 row">
                <!--<div class="col-md-6">-->
                <!--    <div class="award pr">-->
                <!--        <h5>Awards</h5>-->
                <!--        <h6>Best Fitnes Trainer - 2018</h6>-->
                <!--        <p>Goldenfitness Gym</p>-->
                <!--        <h6>Best Yoga Trainer - 2017</h6>-->
                <!--        <p>Goldenfitness Gym</p>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-md-6">-->
                <!--    <div class="award educa pl">-->
                <!--        <h5>Education</h5>-->
                <!--        <h6>University of San Fransis 2010</h6>-->
                <!--        <p>Bacjhlor of arts and science</p>-->
                <!--        <h6>University of San Georgia 2013</h6>-->
                <!--        <p>Master of arts and science</p>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>


</html>

<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>

 </div>
</section>
<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>

@endsection