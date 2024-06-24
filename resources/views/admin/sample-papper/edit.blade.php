@extends('admin.layout.layout')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<style>
    .card .card-header {
        border-bottom: 1px solid green;
        position: relative;
        background-color: #f38e27;
    }
</style>
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Sample Papers</h5>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('sample-paper.update', $samplePaper->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label class="floating-label" for="class_id">Select Class</label>
        <select name="class_id" class="form-control" id="class_id">
            <option value="">--Select Class--</option>
            @foreach($classes as $temp)
                <option value="{{ $temp->id }}" {{ $temp->id == $samplePaper->class_id ? 'selected' : '' }}>{{ $temp->name }}</option>
            @endforeach
        </select>
        <span class="text-danger" id="classError">
            @error('class_id')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="form-group">
        <label class="floating-label" for="subject_id">Select Subject</label>
        <select name="subject_id" class="form-control" id="subject_id">
            <option value="">--Select Subject--</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $subject->id == $samplePaper->subject_id ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
            @endforeach
        </select>
        <span class="text-danger" id="subjectError">
            @error('subject_id')
                {{ $message }}
            @enderror
        </span>
    </div>
  
    <div class="form-group">
        <label class="floating-label" for="youtube_link">YouTube Link</label>
        <input type="text" class="form-control" value="{{ $samplePaper->youtube_link }}" name="youtube_link" required>
        <span class="text-danger" id="youtubeLinkError">
            @error('youtube_link')
                {{ $message }}
            @enderror
        </span>
    </div>
    <table id="test-table" class="table table-condensed">
        <tbody id="test-body">
            @foreach($samplePaper->details as $key => $detail)
            <tr id="row{{ $key }}">
                <td>
                    <input name="sample_paper_name[]" placeholder="Sample Paper Name" type="text" class="form-control" value="{{ $detail->sample_paper_name }}" />
                </td>
                <td>
                    <img src="{{ asset($detail->image_path) }}" class="img-thumbnail" style="width: 100px; height: auto;" />
                    <input type="checkbox" name="deleted_images[]" value="{{ $detail->id }}" /> Delete
                </td>
                <td>
                    <input class="delete-row btn btn-primary" type="button" value="Delete" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <input id="add-row" class="btn btn-primary" type="button" value="Add" />
    <div class="form-group">
        <label class="floating-label" for="description">Description</label>
        <textarea name="description" id="form4Example3" required>{{ $samplePaper->description }}</textarea>
        <span class="text-danger" id="descriptionError">
            @error('description')
                {{ $message }}
            @enderror
        </span>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    var row = {{ count($samplePaper->details) }};
    $(document).on("click", "#add-row", function () {
        var new_row = '<tr id="row' + row + '"><td><input name="sample_paper_name[]" placeholder="Sample Paper Name" type="text" class="form-control" /></td><td><input name="image[]" type="file" class="form-control" /></td><td><input class="delete-row btn btn-primary" type="button" value="Delete" /></td></tr>';
        $('#test-body').append(new_row);
        row++;
        return false;
    });

    $(document).on("click", ".delete-row", function () {
        if (row > 1) {
            $(this).closest('tr').remove();
            row--;
        }
        return false;
    });

    $(document).ready(function () {
        $('#form4Example3').summernote({
            height: 200,
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const nameInput = document.getElementById("nameInput");
        const nameError = document.getElementById("nameError");
        nameInput.addEventListener("input", function () {
            const name = nameInput.value;
            const isValid = /[A-Za-z\s\-]+/.test(name);
            if (!isValid) {
                nameError.innerHTML = "The name format is invalid.";
            } else {
                nameError.innerHTML = "";
            }
        });
        const dateInput = document.getElementById("dateInput");
        const dateError = document.getElementById("dateError");
        dateInput.addEventListener("input", function () {
            const selectedDate = new Date(dateInput.value);
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);
            if (selectedDate < currentDate) {
                dateError.innerHTML = "The date must be a date after or equal to today.";
            } else {
                dateError.innerHTML = "";
            }
        });
    });

    const descriptionInput = document.getElementById("form4Example3");
    const descriptionError = document.getElementById("descriptionError");
    descriptionInput.addEventListener("input", function () {
        const description = descriptionInput.value;
        if (description.trim() === "") {
            descriptionError.innerHTML = "The description field is required.";
        } else {
            descriptionError.innerHTML = "";
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#class_id').change(function () {
            var classId = $(this).val();
            if (classId) {
                $.ajax({
                    url: '{{ route("get-subjects", ":class_id") }}'.replace(':class_id', classId),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#subject_id').empty().append('<option value="">--Select Subject--</option>');
                        $.each(data, function (key, value) {
                            $('#subject_id').append('<option value="' + value.id + '">' + value.subject_name + '</option>');
                        });
                    }
                });
            } else {
                $('#subject_id').empty().append('<option value="">--Select Subject--</option>');
            }
        });
    });
</script>
