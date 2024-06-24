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
    .scrollable-content {
    max-height: 200px; /* Adjust the height as needed */
    overflow-y: auto;
    padding: 10px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
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
                              <th scope="col">Chapter Name</th>
                          <th scope="col">Description</th>
                          <th scope="col">Action</th>
                      
                        </tr>
                      </thead>
                      <?php
                      $notes = DB::table("notes")
                            ->join("chapters", "notes.chapter_id", "=", "chapters.id")
                            ->join("subjects", "notes.subject_id", "=", "subjects.id")
                            ->join("categories", "notes.class_id", "=", "categories.id")
                            ->select(
                                "notes.*", 
                                "chapters.chapter_name as chapter_name", 
                                "subjects.subject_name as subject_name", 
                                "categories.name as class_name"
                            )
                            ->orderBy("notes.id", "desc")
                            ->get();

                      ?>
                      <tbody>
                          @foreach($notes as $key => $temp)
                        <tr>
                          <th>{{++$key}}</th>
                          <td>{{$temp->class_name}}</td>
                          <td>{{$temp->subject_name}}</td>
                           <td>{{$temp->chapter_name}}</td>
                          <td>
                            <div class="scrollable-content">
                                {!! $temp->description !!}
                            </div>
                        </td>

                          
                                 <td>
    <div style="display: flex; justify-content: space-between;">
        <form action="{{ route('notes.destroy', $temp->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this note?');">
                <i class="fa fa-trash"></i>
            </button>
        </form>
        
        <a href="{{ route('notes.edit', $temp->id) }}" class="btn btn-primary btn-sm">
            <i class="fa fa-edit"></i>
        </a>
    </div>
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
