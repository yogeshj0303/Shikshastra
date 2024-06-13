<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sikshastra | Chapter Details</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet" />

</head>

<body>
    <!-- Navbar Start -->
 <x-header />
    <!-- Navbar End -->

    <!-- Teacher update Start -->
    
    <!-- Teacher update end -->
    <!-- Teacher update end -->
    <div class="container p-3 my-4">
    
        </div>
    <!-- Teacher update end -->

    <!--chapters  Start -->
    <div class="container p-3 my-4">
        <div class="row">
            <div class="col-lg-8 col-md-8 pb-1">
                <iframe width="100%" height="315" src="{{$getChapter->youtube_link}}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <div>
                        @foreach ($getChapter->note_details as $temp)
                        <img src="{{asset($temp->image_path)}}" alt="" style="width: 100%; margin-top: 20px;">
                        @endforeach
                      
                   
                    </div>
                <div class="d-flex bg-light shadow-sm border rounded mb-4">
                   <div class="container">
                    {!! $getChapter->description !!}
                    <div class="divider"></div>
                   </div>
                </div>
                
            </div>
            <div class="col-lg-4 col-md-4 pb-1">
                <div class="d-flex  shadow-sm border-top rounded mb-4 flex-column">
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th style="background: #daac23;"  scope="col">Other Chapters</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getSubjectChater as $chapter)
                            <tr>
                                <td><a href="{{ url('chapter-details/' . $temp->id) }}" class="text-ternary">{{$chapter->chapter_name}}</a></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th style="background: #daac23;" scope="col">Related Class Subjects</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getClassChater as $class)
                            <tr>
                                <td><a href="{{ route('view-subject', $class->id) }}" class="text-ternary"> Class Solutions for {{$class->class_name}}  {{$class->subject_name}}</a></td>
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