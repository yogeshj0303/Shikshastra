<head>
<meta charset="utf-8" />
  <title>Shikshastra | Home</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="Free HTML Templates" name="keywords" />
  <meta content="Free HTML Templates" name="description" />
</head>
<x-header />
<style>
  .category-card {
  padding: 30px;
  transition: transform 0.3s, box-shadow 0.3s;
}

.category-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.category-icon {
  height: 30px;
  width: 30px;
}

  .description {
    height: 100%; /* Set your desired fixed height here */
    overflow: hidden;
    position: relative; /* Optional: use position relative for absolute positioning */
    overflow:scroll;
    scrollbar-width: none;
}

.description p {
    margin: 0; /* Remove default margin of <p> */
    padding: 10px; /* Optional: add padding for spacing */
}

.description::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 10px; /* Height of the "..." placeholder */
    background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1) 80%);
}

        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            margin-bottom: 20px;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }
        .tab button:hover {
            background-color: #ddd;
        }
        .tab button.active {
            background-color: #ccc;
        }
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>


  <!-- About End -->
<style>
    .blog-card {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.blog-image {
  height: 200px; /* Adjust the height as needed */
  object-fit: cover;
}

.card-body {
  display: flex;
  flex-direction: column;
}

.description {
  flex-grow: 1;
}

/* Ensure all columns are the same height */
.row {
  display: flex;
  flex-wrap: wrap;
}

.col-lg-4 {
  display: flex;
  flex-direction: column;
}

</style>
  <!-- Blog Start -->
  <div class="container-fluid pt-5">
    <div class="container">
      <div class="text-center pb-2">
        <p class="section-title px-5">
          <span class="px-2">Latest Blog</span>
        </p>
        <h1 class="mb-4">Latest Articles From Blog</h1>
      </div>
      <?php
      $blogs = DB::table("blogs")->orderBy("id","desc")->get(); 
      ?>
      <div class="row pb-3">
     @foreach ($blogs as $value)
<div class="col-lg-4 mb-4">
  <div class="card border-0 shadow-sm mb-2 blog-card">
    <img class="card-img-top mb-2 blog-image" src="{{ asset('uploads/blog/'.$value->image) }}" alt="" />
    <div class="card-body bg-light text-center p-4 d-flex flex-column">
      <h4 class="mb-3">{{$value->title}}</h4>
      <div class="description mb-4 flex-grow-1">
        <p>
          @php
          $description = strip_tags($value->description);
          $words = explode(' ', $description);
          $truncatedDescription = implode(' ', array_slice($words, 0, 30)); // Adjust the word limit as needed
          if (count($words) > 40) {
              $truncatedDescription .= '...';
          }
          @endphp
          {!! nl2br(e($truncatedDescription)) !!}
        </p>
      </div>
      <a href="{{ route('blog-details', ['id' => str_replace(' ', '-', $value->title)]) }}" class="btn btn-primary px-4 mx-auto my-2 mt-auto">Read More</a>
    </div>
  </div>
</div>
@endforeach

        <!-- <div class="col-lg-4 mb-4">
          <div class="card border-0 shadow-sm mb-2">
            <img class="card-img-top mb-2" src="{{asset('frontend/img/blog-2.jpg')}}" alt="" />
            <div class="card-body bg-light text-center p-4">
              <h4 class="">Diam amet eos at no eos</h4>
              <div class="d-flex justify-content-center mb-3">
                <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
              </div>
              <p>
                Sed kasd sea sed at elitr sed ipsum justo, sit nonumy diam
                eirmod, duo et sed sit eirmod kasd clita tempor dolor stet
                lorem. Tempor ipsum justo amet stet...
              </p>
              <a href="" class="btn btn-primary px-4 mx-auto my-2">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card border-0 shadow-sm mb-2">
            <img class="card-img-top mb-2" src="{{asset('frontend/img/blog-3.jpg')}}" alt="" />
            <div class="card-body bg-light text-center p-4">
              <h4 class="">Diam amet eos at no eos</h4>
              <div class="d-flex justify-content-center mb-3">
                <small class="mr-3"><i class="fa fa-user text-primary"></i> Admin</small>
                <small class="mr-3"><i class="fa fa-folder text-primary"></i> Web Design</small>
                <small class="mr-3"><i class="fa fa-comments text-primary"></i> 15</small>
              </div>
              <p>
                Sed kasd sea sed at elitr sed ipsum justo, sit nonumy diam
                eirmod, duo et sed sit eirmod kasd clita tempor dolor stet
                lorem. Tempor ipsum justo amet stet...
              </p>
              <a href="" class="btn btn-primary px-4 mx-auto my-2">Read More</a>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Blog End -->

<x-footer />
</body>

</html>