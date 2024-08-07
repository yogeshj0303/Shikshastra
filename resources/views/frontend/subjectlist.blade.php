<head>
<meta charset="utf-8" />
  <title>Shikshastra | Chapters</title>
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
        <h1 class="text-white display-5 font-weight-bold m-0">Class Solutions For  @if (!empty($getClassName))
          {{ $getClassName->name ?? '' }}
        @endif</h1>
    </div>
    <!-- Facilities Start -->

    <!-- Teacher update Start -->
    <div class="d-flex container my-4">
        <div>
            <img src="{{asset('frontend/img/reload.png')}}" alt="" style="height: 50px; width: 50px; margin-right: 10px;">
        </div>
        <div>
            <h1 class="text-primary display-subtitle font-weight-bold m-0">
                Update by : Mohit sharma
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
      <th scope="col">
        @if (!empty($getClassName) || !empty($getSubjectName))
          {{ $getClassName->name ?? '' }} (Class) - {{ $getSubjectName->subject_name ?? '' }} (Subject)
        @endif
        all chapters
      </th>
    </tr>
  </thead>
  <tbody>
    @foreach ($getSubject as $temp)
    <tr>
      <td>
        <a href="{{ url('chapter-details/' . $temp->id) }}">
          <img src="{{ asset('frontend/img/checked.png') }}"
               style="width: 15px; height: 15px;" alt="Tick">
          {{ $temp->chapter_name }}
        </a>
      </td>
    </tr>
    @endforeach

    @if (empty($getSubject))
    <tr>
      <td colspan="1" style="text-align: center;">Chapter not found.</td>
    </tr>
    @endif
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
                            @if (!empty($getRelatedSubject))
                            @foreach ($getRelatedSubject as $value)
                        <tr>
                                <td><a href="{{ route('view-subject', $value->id) }}" class="text-ternary"> Class Solutions for {{$getClassName->name}} {{$value->subject_name}}</a></td>
                            </tr>
                        @endforeach
                            @endif
                      
                           
                        </tbody>
                    </table>
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Mathematics for Senior Classes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $getSeniorMathsClasses = DB::table('categories')
    ->whereIn('name', ['Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10', 'Class 11', 'Class 12'])
    ->leftJoin('subjects', 'categories.id', '=', 'subjects.class_id')
    ->select('categories.*', 'subjects.subject_name')
    ->get();
?>

                        @foreach ($getSeniorMathsClasses as $new)
                        <tr>
                                <td><a href="" class="text-ternary"> Class Solutions for {{$new->name}} Maths</a></td>
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