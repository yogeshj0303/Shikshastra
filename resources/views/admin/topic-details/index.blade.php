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
                                <h5 class="m-b-10">Notes</h5>
                                <a href="{{route('notes.create')}}" class="button">Add +</a>
                            
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
                          <th scope="col">Image</th>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                      
                        </tr>
                      </thead>
                      <?php
                        $notes = DB::table("notes")->orderBy("id","desc")->get();
                      ?>
                      <tbody>
                          @foreach($notes as $key => $temp)
                        <tr>
                          <th>{{++$key}}</th>
                          <td></td>
                          <td><img src="" style="height: 50px; width:50px;"></td>
                          <td></td>
                           <td>{!!$temp->description!!}</td>
                          
                                   <td>
                                        
                                         
                                          
                                           <a href="{{route('notes.destroy',$temp->id)}}" >   <i class="fa fa-trash"></i></a>
                                       
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
