@extends('admin.layout.layout')
@section('content')
@php
 $new = Session::get('adminId');
    $user=DB::table('admins')->where('id',$new)->first();
$permission = DB::table('add_roles')->where('id', $user->role_id)->first();

 
@endphp
<style>

    /* Reduce the width of the vertical scrollbar on the right side */
::-webkit-scrollbar {
    width: 4px; /* Width of vertical scrollbar */
    height: 4px; /* Height of horizontal scrollbar */
}

/* Style the vertical scrollbar track (the background) */
::-webkit-scrollbar-track {
    background-color: #f1f1f1;
}

/* Style the vertical scrollbar thumb (the draggable part) */
::-webkit-scrollbar-thumb {
    background-color: #888;
    border-radius: 4px;
}

/* Reduce the width of the horizontal scrollbar on the bottom */
::-webkit-scrollbar-thumb:horizontal {
    width: 8px;
}

/* Style the horizontal scrollbar track (the background) */
::-webkit-scrollbar-track:horizontal {
    background-color: #f1f1f1;
}

/* Style the horizontal scrollbar thumb (the draggable part) */
::-webkit-scrollbar-thumb:horizontal {
    background-color: #888;
    border-radius: 4px;
}

</style>
    <section class="pcoded-main-container">
        <div class="pcoded-content">
              <h5 class="m-b-10">Blogs</h5>
            <!-- [ breadcrumb ] start -->
            <!--<div class="page-header">-->
            <!--    <div class="page-block">-->
            <!--        <div class="row align-items-center">-->
            <!--            <div class="col-md-12">-->

            <!--                <div class="page-header-title">-->
                              
            <!--                </div>-->
                           
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div style="float: right;"> 
                        <div class="row">
                 
            <a href="{{ route('blog.create') }}" style="margin-left:14px;" class="btn btn-primary">Add Blog Here...</a>
      




   
    </div>
</div>

                          
                        @if (session()->has('Message'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('Message') }}
                            </div>
                        @endif
                        @if (session()->has('Error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('Error') }}
                            </div>
                        @endif
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                               <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr >
                                            <th>S N.</th>
                                            <th>Blag Title</th>
                                          
                                             <th>Image</th>
                                            <th>Description</th>
                                           
                                        
                                                <th>Action</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach ($data as $key => $value)
                                            <tr >
                                                <th scope="row">{{$data->firstItem() + $key }}</th>
                                                <td>{{ $value->title }}</td>
                                                  <td> <img src="{{ asset('uploads/blog/'.$value->image) }}" alt="Image" width="150" height="150"/>
</td>
                                                             <td>{!! $value->description !!}</td>
                                                                      
                                         
                               
 

                                                 
                                             
                                                      <td>
                                         <a href="{{route('blog.edit',$value->id)}}" > <i class="fa fa-edit"></i></a>
                                  
                                    
                                           <a href="{{route('blog-delete',$value->id)}}" >   <i class="fa fa-trash"></i></a>
                                  
                                                </td>
                                             
                                            </tr>
                                        @endforeach
                                           
                                       
                                    </tbody>
                                </table>
                                                <div class="d-flex justify-content-center" style="margin-left: auto;">
                {{ $data->links() }}
            </div>
                            </div>
                        </div>
                      
                    </div>
                </div>

            </div>

        </div>
    </section>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Initially, show all rows
        $('#dataTable tbody tr').show();

        // Handle click events on filter options
        $('#filterDropdown a').click(function () {
            const filterValue = $(this).data('filter');
            if (filterValue === 'all') {
                $('#dataTable tbody tr').show();
            } else if (filterValue === 'yearly') {
                // Handle Yearly Filter
                $('#dataTable tbody tr').hide();
                $(`#dataTable tbody tr[data-filter*="yearly"]`).show();
            } else if (filterValue === 'monthly') {
                // Handle Monthly Filter
                $('#dataTable tbody tr').hide();
                $(`#dataTable tbody tr[data-filter*="monthly"]`).show();
            } else {
                // Handle Plan Category Filter
                $('#dataTable tbody tr').hide();
                $(`#dataTable tbody tr[data-filter*="${filterValue}"]`).show();
            }
        });

        // Handle input search
        $('#searchInput').on('keyup', function () {
            const searchText = $(this).val().toLowerCase();
            $('#dataTable tbody tr').hide();
            
            // Loop through all rows and cells to find a match
            $('#dataTable tbody tr').each(function () {
                const row = $(this);
                row.find('td').each(function () {
                    const cellText = $(this).text().toLowerCase();
                    if (cellText.includes(searchText)) {
                        row.show();
                        return false; // Exit the cell loop for this row
                    }
                });
            });
        });
    });
</script>





@endsection
