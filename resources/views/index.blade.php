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
  <!-- Header Start -->
  <div class="container-fluid bg-white px-0 px-md-5 mb-5">
    <div class="row align-items-center px-3">
        <div class="col-lg-6 text-center text-lg-left">
            <h1 class="display-3 font-weight-bold text-primary">
                Transforming Education for Young Minds
            </h1>

            <!-- Tabs -->
            <div class="tab">
                <button class="tablinks" onclick="openLanguage(event, 'English')" id="defaultOpen">English</button>
                <button class="tablinks" onclick="openLanguage(event, 'Hindi')">Hindi</button>
            </div>

            <!-- English Content -->
            <div id="English" class="tabcontent">
                <p class="text-secondary mb-4">
                    You've likely heard the saying, "The well does not go to the thirsty; the thirsty must reach the well." But we believe that everyone deserves equal access to resources, and it is our moral duty to ensure that every thirsty person gets their share of water. The children who go to school each morning with their backpacks are the future of our country. We must also remember those children who have set aside their backpacks to help support their families.
                    <br><br>
                    Our mission is to bring the greatest hope of the modern world to children who lack resources. We want to put books and pens in their hands and light the flame of curiosity in their minds. This light will help them see their goals and brighten their world. While we are not the first nor the last to make this effort, we believe our small contribution can make a difference.
                    <br><br>
                    To address the many challenges our country faces, we need a powerful tool—education. This education should not just be about books but should spark questions and curiosity at every step, helping us understand ourselves and the world. If given at the right time, education has the power to help us overcome even the biggest challenges.
                    <br><br>
                    Our continuous effort is to reach every child who wants to learn and grow. Together, we are the hope for children who want books in their hands and the trust for those who dream of shaping their future. We need your love, support, and partnership in this mission, and we know you are with us. We have the ability to make this happen, and that is why we are Shikshastra.
                </p>
            </div>

            <!-- Hindi Content -->
            <div id="Hindi" class="tabcontent">
                <p class="text-secondary mb-4">
                    आपने यह पुरानी बात जरूर सुनी होगी 'कुआं प्यासे के पास चलकर नहीं जाता, प्यासे को कुएं के पास पहुंचना होता है'...
                    लेकिन हम जानते हैं कि संसाधनों पर सभी का बराबर रूप से हक है, तो यह हमारी नैतिक जिम्मेदारी है कि हर प्यासे तक उसके हिस्से का पानी जरूर पहुंचाया जाए। हमारे घर में, पड़ोस में, मोहल्ले में, गांव और शहरों में सुबह-सुबह अपने कंधे पर बस्ता टांग कर जो बच्चे स्कूल जाते हैं, वे हमारे देश का भविष्य हैं, और हमारे देश के भविष्य में उन बच्चों का नाम भी उतनी ही शिद्दत से लिया जाना चाहिए जिन्होंने अपना घर चलाने के लिए अपने कंधे से बस्ता इसलिए उतार दिया ताकि जिम्मेदारियों का बोझ उठा सकें।
                    <br><br>
                    ऐसे बच्चे जिनके पास संसाधनों की कमी है, हमारा उद्देश्य है उन तक आधुनिक दुनिया की सबसे बड़ी उम्मीद पहुंचाना। उनके हाथों में किताब-कलम और उनके ज़हन में जिज्ञासा का वह दिया जलाना, जिसकी रोशनी से वे अपने लक्ष्य को पहचाने और अपनी दुनिया को रोशन करें। हम यह प्रयास करने वाले पहले नहीं हैं और ना ही आखिरी, लेकिन हम जानते हैं कि हमारे इस छोटे से योगदान से इस तस्वीर में कुछ बदलाव जरूर आएगा।
                    <br><br>
                    देश में उठने वाली तमाम छोटी और बड़ी समस्याओं का सामना करने के लिए एक बहुत ही कारगर अस्त्र प्रयोग में लाया जाना चाहिए और सदियों से उसका प्रयोग किया जाता रहा है, वह है शिक्षा। ऐसी शिक्षा जो सिर्फ किताबों पर आधारित नहीं है बल्कि हमारे मन में कदम-कदम पर प्रश्न और जिज्ञासा पैदा करती है जिससे हमें सबसे पहले स्वयं को और फिर इस संसार को जानने का अवसर मिलता है। शिक्षा में वह क्षमता है यदि वह सही समय पर हर विद्यार्थी को दी जाए, तो हममें बड़ी से बड़ी समस्याओं से लड़ने और उनका सामना करने की क्षमता पैदा की जा सकती है।
                    <br><br>
                    हमारा निरंतर और सतत प्रयास है हर उस बच्चे तक पहुंचना जो पढ़ना चाहता है, बढ़ना चाहता है। आप और हम उम्मीद हैं उन बच्चों की जो अपने हाथ में किताब चाहते हैं, विश्वास हैं उन बच्चों का जो अपने सपनों को आकार देना चाहते हैं। हमारी इस मुहीम में हमें आपका प्रेम, स्नेह और साथ चाहिए और हम जानते हैं कि आप हमारे साथ हैं। हम यह सब करने की क्षमता रखते हैं, इसीलिए हम शिक्षास्त्र हैं।
                </p>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <img class="img-fluid mt-5" src="https://www.educategirls.ngo/wp-content/uploads/2023/09/fundraising-from-new-age-philanthropists_-educate-girls_-ngo-_-blog-2.jpg" alt="Shikshastra Education Image" />
        </div>
    </div>
</div>

<script>
    function openLanguage(evt, languageName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(languageName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();
</script>
  <!-- Header End -->

  <!-- Facilities Start -->
  <div class="container-fluid pt-5">
    <div class="container pb-3">
      <div class="row">
        <?php
          $getClass = DB::table("categories")->get();
        ?>
        @foreach ($getClass as $temp)
        <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
          <a href="{{url('get-subject/'.$temp->id)}}">
            <div class="d-flex bg-light shadow-sm border-top rounded mb-4 category-card">
              <img src="{{asset('frontend/img/pencil.png')}}" alt="Category Icon" class="category-icon">
              <div class="pl-4">
                <h4>{{$temp->name}}</h4>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- Facilities Start -->
  <!-- About Start -->
  <div class="container-fluid py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid rounded mb-5 mb-lg-0" src="https://images.unsplash.com/flagged/photo-1574097656146-0b43b7660cb6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="School Image" />
            </div>
            <div class="col-lg-7">
                <p class="section-title pr-5">
                    <span class="pr-2">Learn About Us</span>
                </p>
                <h1 class="mb-4">Why Have You Chosen Us?</h1>
                <p>
                    We don't claim to be the biggest or the best educational institution. Our mission is simple: whenever a child wants to learn but lacks resources, we want to be there for them. Not as a ladder to climb, but as the nurturing roots that help them grow from a sapling into a strong tree.
                </p>
                <p>
                    We believe in reminding them that just as we helped them grow, it's now their turn to give back. Their duty is to make the world a more beautiful and better place to live. This cycle of growth and giving back is what makes life truly meaningful.
                </p>
                <div class="row pt-2 pb-4">
                    <div class="col-12">
                        <ul class="list-inline m-0">
                            <li class="py-2 border-top border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Committed to providing quality education
                            </li>
                            <li class="py-2 border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Supportive learning environment
                            </li>
                            <li class="py-2 border-bottom">
                                <i class="fa fa-check text-primary mr-3"></i>Encouraging personal and academic growth
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="{{url('about-us')}}" class="btn btn-primary mt-2 py-2 px-4">Learn More</a>
            </div>
        </div>
    </div>
</div>

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
      $blogs = DB::table("blogs")->orderBy("id","desc")->take(3)->get(); 
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
<a href="{{url('all-blogs')}}" class="btn btn-primary px-4 mx-auto my-2 mt-auto">View All</a>

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