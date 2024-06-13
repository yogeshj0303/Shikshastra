<head>
<meta charset="utf-8" />
  <title>Shikshastra | Subjects</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="Free HTML Templates" name="keywords" />
  <meta content="Free HTML Templates" name="description" />
</head>
<x-header />
    <!-- Facilities Start -->
    <div class="container p-3 heading-bg my-4">
        <h1 class="text-white display-subtitle font-weight-bold m-0">
            <span>Sikshastra / </span>
            <span>NCERT Solutions / </span>
            <span>NCERT Solutions For Class 1 / </span>
            <span>NCERT Solutions For Class 1 (Hindi)</span>
        </h1>
        <h1 class="text-white display-5 font-weight-bold m-0">NCERT Solutions For Class 1</h1>
    </div>
    <!-- Facilities Start -->

    <!-- Teacher update Start -->
    <div class="d-flex container my-4">
        <div>
            <img src="./img/reload.png" alt="" style="height: 50px; width: 50px; margin-right: 10px;">
        </div>
        <div>
            <h1 class="text-primary display-subtitle font-weight-bold m-0">
                Update by : Rohan sharma
            </h1>
            <h1 class="text-primary display-subtitle font-weight-bold m-0">
                on December 21, 2024 6:08AM
            </h1>
        </div>
    </div>
 
    <p class="text-secondary mb-4 container">
        Sea ipsum kasd eirmod kasd magna, est sea et diam ipsum est amet sed
        sit. Ipsum dolor no justo dolor et, lorem ut dolor erat dolore sed
        ipsum at ipsum nonumy amet. Clita lorem dolore sed stet et est justo
        dolore.
    </p>
    <!-- Teacher update end -->

    <!--chapters  Start -->
    <div class="container p-3 my-4">
        <div class="row">
            <div class="col-lg-8 col-md-8 pb-1">
                <div class="d-flex bg-light shadow-sm border rounded mb-4">
                    <table class="table px-lg-5">
                        <thead>
                            <tr>
                                <th scope="col">Class 1 all subjects</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getSubject as $sub)
                            <tr>
                                <td><a href="{{ route('view-subject', $sub->id) }}"><img src="{{asset('frontend/img/checked.png')}}"
                                            style="width: 15px; height: 15px;" alt="Tick">{{$sub->subject_name}}</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 pb-1">
                <div class="d-flex  shadow-sm border-top rounded mb-4 flex-column">
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Related Links</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $getClass = DB::table("categories")->get();
                            ?>
                            @foreach ($getClass as $temp)
                            <tr>
                                <td><a href="{{url('get-subject/'.$temp->id)}}" class="text-ternary"> Class Solutions for {{$temp->name}}</a></td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- chapters end -->
<x-footer />