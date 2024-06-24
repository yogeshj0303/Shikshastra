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
  .description-container {
        width: 400px;
        height:100px;
        overflow: scroll;
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
                                <a href="{{route('sample-paper.create')}}" class="button">Add +</a>
                            
                            </div>
                   
                    </div>
                </div>
            </div>
        </div>
        @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

        <div class="row">
           

                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Class Name</th>
                          <th scope="col">Subject Name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                      
                        </tr>
                      </thead>
                     
                      <tbody>
                          @foreach($data as $key => $temp)
                        <tr>
                          <th>{{++$key}}</th>
                          <td>{{$temp->class_name}}</td>
                          <td>{{$temp->subject_name}}</td>
<td>
    <div class="description-container">
        {!! $temp->description !!}
        </div>
 
</td>



                          
                                <td>
                                      <a href="{{ route('sample-paper.edit', $temp->id) }}" class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </a>
                                            <form action="{{ route('sample-paper.destroy', $temp->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                 <button type="submit" class="btn btn-danger btn-sm delete-btn" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fa fa-trash"></i></button>
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
