<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Shikshastra | Sample Papers</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />


    <style>


    </style>
</head>

<body>
    <!-- Navbar Start -->
   <x-header />


    <!-- Navbar End -->
    <!--chapters  Start -->
    <div class="container p-3 my-4">
        <div class="row">
            <div class="col-lg-8 col-md-8 pb-1">
                <hr>
                <p class="h1">Sample Papers for {{$getClassName->name}}</p>
                <hr>
                @foreach ($subjects as $temp)
    <div class="d-flex bg-light shadow-sm border rounded mb-4">
        <table class="table px-lg-5">
            <thead>
                <tr>
                    <th scope="col" class="h3">Sample Papers for {{$temp->class_name}} {{$temp->subject_name}} Session 2024 – 2025</th>
                </tr>
            </thead>
            <tbody>
                @if ($temp->sample_papers->isEmpty())
                    <tr>
                        <td>  <p class="text-danger">Sample paper not available in this subject</p></td>
                    </tr>
                @else
                    @foreach ($temp->sample_papers as $samplePaper)
                        @foreach ($samplePaper->sample_details as $new)
                            <tr>
                                <td>
                                    <a href="{{ asset($new->image_path) }}" target="_blank">
                                        <img src="{{asset('frontend/img/checked.png')}}" style="width: 15px; height: 15px;" alt="Tick">
                                        {{$new->sample_paper_name}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endforeach


                <!-- <div class="d-flex bg-light shadow-sm border rounded mb-4">
                    <table class="table px-lg-5">
                        <thead>
                            <tr>
                                <th scope="col" class="h3">Sample Papers for Class 9 Hindi Session 2021 – 2022</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Hindi Practice Paper 1</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Hindi Practice Paper 1 OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Hindi Practice Paper 1 Answers</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Hindi Practice Paper 2</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Hindi Practice Paper 2 OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Hindi Practice Paper 2 Answers</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex bg-light shadow-sm border rounded mb-4">
                    <table class="table px-lg-5">
                        <thead>
                            <tr>
                                <th scope="col" class="h3">Sample Papers for Class 9 Science Session 2021 – 2022</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 1 OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 1 Answers</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 2</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 2 OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 2 Answers</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 3</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 3 OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 3 Answers</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 4</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 4 OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 4 Answers</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 5</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 5 OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Practice Paper 5 Answers</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Revision Test Paper</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Revision Test Paper OMR Sheet</a></td>
                            </tr>
                            <tr>
                                <td><a href="chapterDetails.html"><img src="./img/checked.png"
                                            style="width: 15px; height: 15px;" alt="Tick"> Class
                                        9 Science Revision Test Paper Answers</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
                <!-- <hr>
                <p class="h1">Class 9 Science Sample Paper 1 Explanation</p>
                <hr>
                <div class="py-3">
                    <iframe width="100%" height="315"
                        src="https://www.youtube.com/embed/dXuPwVDXbZg?si=3aRnmXsh0FZ81z4T" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div> -->
               
                <hr>
                <p class="h3">
                     Sample Papers for Class  {{$getClassName->name}} All Subjects
                </p>
                <hr>
                @foreach ($subjects as $allSubject)
    <div class="card mb-4">
        <div class="card-body">
            <p class="h5">{{$allSubject->subject_name}}</p>
            @if ($allSubject->sample_papers->isEmpty())
                <p class="text-danger">Sample paper not available in this subject</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($allSubject->sample_papers as $samplePaper)
                        @foreach ($samplePaper->sample_details as $temp)
                        <a href="{{ asset($new->image_path) }}" target="_blank"><li class="list-group-item">{{$temp->sample_paper_name}}</li></a> 
                        @endforeach
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endforeach

<!--                 
                <div>
                    <p class="h5">Maths</p>
                    <ul>
                        <li>Sample Paper 1</li>
                        <li>Sample Paper 1 Solutions</li>
                        <li>Sample Paper 2</li>
                        <li>Sample Paper 2 Solutions</li>
                        <li>Sample Paper 3</li>
                    </ul>
                </div>
                <div>
                    <p class="h5">Science</p>
                    <ul>
                        <li>Sample Paper 1</li>
                        <li>Sample Paper 1 Solutions</li>
                        <li>Sample Paper 2</li>
                        <li>Sample Paper 2 Solutions</li>
                        <li>Sample Paper 3</li>
                    </ul>
                </div> -->
            </div>
            <div class="col-lg-4 col-md-4 pb-1">
                <div class="d-flex  shadow-sm border-top rounded mb-4 flex-column">
                    
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th scope="col"  class="h4">Mathematics for Senior Classes</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><a href="#" class="text-ternary"> NCERT Solutions for Class 1 English</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary"> NCERT Solutions for Class 1 Maths</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary"> Class 1 GK General Knowledge Book Question
                                        Answers</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary"> NCERT Solutions for Class 1 EVS</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary"> NCERT Solutions for Class 1 Computer Science</a>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary"> NCERT Solutions for Class 1 Science</a></td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th scope="col"  class="h4">Important Links</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" class="text-ternary">NCERT</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">Important Questions</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">Vedic Maths Tricks</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">Link Study Materials</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">Useful Resources & Formulae</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">Holiday Homework Solutions</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="h4">Mathematics for Junior Classes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" class="text-ternary">NCERT Solutions Class 5 Maths</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">NCERT Solutions Class 4 Maths</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">NCERT Solutions Class 3 Maths</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">NCERT Solutions Class 2 Maths</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">NCERT Solutions Class 1 Maths</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">Class KG Maths Study Material</a></td>
                            </tr>
                            <tr>
                                <td><a href="#" class="text-ternary">Class Nursery Maths Study Material</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- chapters end -->

    <!-- Footer Start -->
    <x-footer />