@extends('admin.layout.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    <section class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">

                            <div class="page-header-title">
                                <h5 class="m-b-10">Faq</h5>
                            </div>
                            {{--  <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Components</a></li>
                            <li class="breadcrumb-item"><a href="#!">Form Elements</a></li>
                        </ul>  --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            <h5>FAQ</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('faqcategory.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf


                                <div class="form-group">
                                    <label class="floating-label" for="Email">Category Name</label>
                                    <input type="text" class="form-control" name="name" id="Email"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label class="floating-label" for="Text">Image</label>
                                    <input type="file" class="form-control" name="image" id="Text" placeholder=""
                                        required>
                                </div>
                                <button type="submit" class="btn  btn-primary">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- [ form-element ] start -->
                <div class="col-sm-6">
                    <div class="card">
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
                        <div class="card-header">
                            <h5>Job Category</h5>
                            {{--  <span class="d-block m-t-5">use class <code>table-striped</code> inside table element</span>  --}}
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S N.</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td><img src="{{ asset('uploads/job/'.$value->image) }}" style="height:50px; width:50px;"> </td>
                                                <td>
                                                    <form action="{{ route('faqcategory.destroy', $value->id) }}" method="POST">
                                                        @csrf
                                                        @method('Delete')
                                                        <button class="btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ form-element ] end -->
            </div>

        </div>
    </section>
@endsection
