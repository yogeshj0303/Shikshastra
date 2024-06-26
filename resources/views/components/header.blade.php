<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

  <!-- Flaticon Font -->
  <link href="{{ asset('frontend/lib/flaticon/font/flaticon.css') }}" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('frontend/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />
  <link rel="icon" href="{{ asset('backend/assets/images/favicon.jpg') }}" />

  <style>

/* screenshot and copy text restric */

    .nav-item {
      position: relative;
    }

    .nav-item::after {
      content: "";
      display: block;
      width: 100%;
      height: 1px;
      background-color: #ddd;
      position: absolute;
      bottom: 0;
      left: 0;
    }

    .nav-item:last-child::after {
      display: none;
    }

    .nav-item .dropdown-menu {
      display: none;
    }

    .nav-item:hover > .dropdown-menu {
      display: block;
    }
  </style>
</head>

<body>
  <!-- Navbar Start -->
  <div class="container-fluid bg-dark bg-gradient position-relative shadow">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5 bg-dark bg-gradient">
      <a href="{{ url('/') }}" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px">
        <img src="{{ asset('frontend/img/heading-log.png') }}" alt="" style="height: 45px; width: 100%; background-color: black;">
      </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <ul class="navbar-nav font-weight-bold mx-auto py-0">
          <li class="nav-item">
            <a href="{{ url('/home-page') }}" class="nav-link active">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('about-us') }}" class="nav-link">About Us</a>
          </li>
          <?php
          use Illuminate\Support\Facades\DB;
          $classes = DB::table('categories')->get();

          // Pre-filter subjects by class ID
          $subjectsByClass = DB::table('subjects')
            ->select('subjects.*', 'categories.id AS category_id')
            ->join('categories', 'categories.id', '=', 'subjects.class_id')
            ->get()
            ->groupBy('category_id');
          // Fetch languages for each subject and attach them
          foreach ($subjectsByClass as $category_id => $subjects) {
            foreach ($subjects as $subject) {
              $languages = DB::table('languages')->where('subject_id', $subject->id)->get();
              $subject->lang_name = $languages;
            }
          }

          $subjectsBySample = DB::table('categories')
            ->orderBy('id', 'desc') // Order the records by id in descending order
            ->take(4) // Take the first 4 records in descending order
            ->get()
            ->reverse();
          ?>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sample Papers</a>
            <ul class="dropdown-menu rounded-0 m-0">
              @foreach ($subjectsBySample as $sample)
              <li class="nav-item dropdown-submenu">
                <a href="{{ url('sample-paper-details/' . $sample->id) }}" class="dropdown-item">Sample Papers for {{ $sample->name }}</a>
              </li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Class Solutions</a>
            <ul class="dropdown-menu rounded-0 m-0">
              @foreach ($classes as $class)
              <li class="nav-item dropdown-submenu">
                <a href="{{ url('get-subject/' . $class->id) }}" class="dropdown-item">{{ $class->name }}</a>
                @if (isset($subjectsByClass[$class->id]) && !empty($subjectsByClass[$class->id]))
                <ul class="dropdown-menu rounded-0 m-0">
                  @foreach ($subjectsByClass[$class->id] as $subject)
                  <li class="nav-item dropdown-submenu">
                    <a href="{{ route('view-subject', $subject->id) }}" class="dropdown-item">{{ $subject->subject_name }}</a>
                    <!-- @if (isset($subject->lang_name) && $subject->lang_name->isNotEmpty())
                    <ul class="dropdown-menu rounded-0 m-0">
                      @foreach ($subject->lang_name as $language)
                      <li><a href="{{ url('view-language', ['subject_id' => $subject->id, 'language' => $language->name]) }}" class="dropdown-item">{{ $language->name }}</a></li>
                      @endforeach
                    </ul>
                    @endif -->
                  </li>
                  @endforeach
                </ul>
                @endif
              </li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('gallery') }}" class="nav-link">Gallery</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('contact-us') }}" class="nav-link">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- Navbar End -->

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const dropdownSubmenus = document.querySelectorAll('.nav-item.dropdown-submenu');

      dropdownSubmenus.forEach(submenu => {
        submenu.addEventListener('mouseover', function() {
          const dropdownMenu = this.querySelector('.dropdown-menu');
          if (dropdownMenu) {
            dropdownMenu.style.display = 'block';
          }
        });

        submenu.addEventListener('mouseout', function() {
          const dropdownMenu = this.querySelector('.dropdown-menu');
          if (dropdownMenu) {
            dropdownMenu.style.display = 'none';
          }
        });

        submenu.addEventListener('click', function(e) {
          e.stopPropagation();
          const dropdownMenu = this.querySelector('.dropdown-menu');
          if (dropdownMenu) {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
          }
        });
      });

      const navbarItems = document.querySelectorAll('.navbar-nav .nav-item');
      navbarItems.forEach(item => {
        item.addEventListener('mouseover', function() {
          const dropdownMenu = this.querySelector('.dropdown-menu');
          if (dropdownMenu) {
            dropdownMenu.style.display = 'block';
          }
        });

        item.addEventListener('mouseout', function() {
          const dropdownMenu = this.querySelector('.dropdown-menu');
          if (dropdownMenu) {
            dropdownMenu.style.display = 'none';
          }
        });
      });
    });
  </script>
</body>

</html>
