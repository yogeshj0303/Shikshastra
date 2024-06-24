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
                        <h5>Edit Topic Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="floating-label" for="class_id">Select Class</label>
                                <select name="class_id" class="form-control" id="class_id">
                                    <option value="">--Select Class--</option>
                                    @foreach($classes as $temp)
                                    <option value="{{ $temp->id }}" @if($temp->id == $note->class_id) selected @endif>{{ $temp->name }}</option>
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
                                    <option value="{{ $subject->id }}" @if($subject->id == $note->subject_id) selected @endif>{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="subjectError">
                                    @error('subject_id')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="floating-label" for="chapter_id">Select Chapter</label>
                                <select name="chapter_id" class="form-control" id="chapter_id">
                                    <option value="">--Select Chapter--</option>
                                    @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}" @if($chapter->id == $note->chapter_id) selected @endif>{{ $chapter->chapter_name }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="chapterError">
                                    @error('chapter_id')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="floating-label" for="youtube_link">YouTube Link</label>
                                <input type="text" class="form-control" value="{{ $note->youtube_link }}" name="youtube_link" required>
                                <span class="text-danger" id="youtubeLinkError">
                                    @error('youtube_link')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                         <div class="form-group">
                                <label class="floating-label" for="existing_images">Existing Images</label>
                                <div class="row">
                                    @foreach($note->details as $detail)
                                        <div class="col-md-3">
                                            <img src="{{ asset($detail->image_path) }}" class="img-thumbnail" style="width: 100%; height: 100%;" />
                                            <input type="checkbox" name="existing_images[]" value="{{ $detail->id }}" /> Delete
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <table id="test-table" class="table table-condensed">
                                <tbody id="test-body">
                                    <tr id="row0">
                                        <td>
                                            <input name="image[]" type="file" class="form-control" />
                                        </td>
                                        <td>
                                            <input class="delete-row btn btn-primary" type="button" value="Delete" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
>
                            <input id="add-row" class="btn btn-primary" type="button" value="Add" />
                            <div class="form-group">
                                <label class="floating-label" for="description">Description</label>
                                <textarea name="description" id="form4Example3" required>{{ $note->description }}</textarea>
                                <span class="text-danger" id="descriptionError">
                                    @error('description')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
    var row = {{ count($note->details) }};
    $(document).on("click", "#add-row", function () {
        var new_row = '<tr id="row' + row + '"><td><input name="image[]" type="file" class="form-control" /></td><td><input class="delete-row btn btn-primary" type="button" value="Delete" /></td></tr>';
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

        $('#subject_id').change(function () {
            var subjectId = $(this).val();
            if (subjectId) {
                $.ajax({
                    url: '{{ route("get-chapters", ":subject_id") }}'.replace(':subject_id', subjectId),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#chapter_id').empty().append('<option value="">--Select Chapter--</option>');
                        $.each(data, function (key, value) {
                            $('#chapter_id').append('<option value="' + value.id + '">' + value.chapter_name + '</option>');
                        });
                    }
                });
            } else {
                $('#chapter_id').empty().append('<option value="">--Select Chapter--</option>');
            }
        });
    });
</script>
