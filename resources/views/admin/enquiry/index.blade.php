@extends('admin.layout.layout')
@section('content')

<style>
    .page-header-title {
        display: flex;
        justify-content: space-between;
    }
    .page-header-title a {
        padding: 5px 10px;
        background: #f38e27;
        color: #FFFFFF;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
<div class="pcoded-main-container">
   
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                          <div class="page-header-title">
                                <h5 class="m-b-10">All Enquiry</h5>
                                <!-- <a href="{{route('sample-paper.create')}}" class="button">Add +</a> -->
                            
                            </div>
                   
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
           

                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Mobile No</th>
                          <th scope="col">Email</th>
                          <th scope="col">Subject</th>
                          <th scope="col">Message</th>
                          <th scope="col">Action</th>
                      
                        </tr>
                      </thead>
                     
                      <tbody>
                        <?php
                        $data = DB::table("enquiries")->orderBy("id","desc")->get();
                        ?>
                          @foreach($data as $key => $temp)
                        <tr>
                          <th>{{++$key}}</th>
                          <td>{{$temp->name}}</td>
                          <td>{{$temp->mobile_no}}</td>
                          <td>{{$temp->email}}</td>
                          <td>{{$temp->subject}}</td>
                          <td>{{$temp->message}}</td>
                          
                                   <td>
                                        
                                         
                                          
                                   <form action="{{ route('enquiry.destroy', $temp->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
                                                </td>
                                     
                        
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
               
            
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
