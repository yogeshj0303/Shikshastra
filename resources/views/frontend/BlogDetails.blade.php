<x-header />

    <!--chapters  Start -->
    <div class="container p-3 my-4">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-md-8 pb-1">
                <img src="{{ asset('uploads/blog/'.$value->image) }}" alt="" style="width: 100%;height: 350px;" />
                <div class="py-4">
                    <p class="h2">{{$value->title}}</p>
                </div>
                <div class="py-1">
                    <p class="text-secondary">
                    {!! $value->description !!}
                    </p>
                   
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-md-4 pb-1">
                <div class="d-flex  shadow-sm border-top rounded mb-4 flex-column">
                    <table class="table px-lg-5 table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="h4">Related Blogs</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
      $blogs = DB::table("blogs")->orderBy("id","desc")->take(6)->get(); 
      ?>

      @foreach ($blogs as $blog)
      
     
                            <tr>
                            
                                <td>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-2 pb-1">
                                            <img src="{{ asset('uploads/blog/'.$blog->image) }}" alt=""
                                                style="width: 100px;height: 50px;" />
                                        </div>
                                        <div class="col-lg-8 col-md-10 pb-1">
                                            <div class="ml-2">
                                                <p class="h6">{{$blog->title}}</p>
                                                <a href="{{ route('blog-details', ['id' => str_replace(' ', '-', $blog->title)]) }}"> <button class=""
                                                    style="background-color: black;color: white; border-radius: 8px; border: none;">Read More</button>
                                                    </a>
                                                </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 pb-1">
                                            <hr style="height: 1px; background-color: gray;width: 100%;" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          
                            

                        </tbody>
                    </table>
                </div>
            </div>
          
        </div>
    </div>
    <!-- chapters end -->

    <!-- Footer Start -->
   <x-footer />
   