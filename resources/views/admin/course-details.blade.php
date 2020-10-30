@extends('admin/layout')


@section('Content')
<a href="/admin">Back</a>
<h2>Course Details</h2><br>

    @foreach ($courses as $course)
        <form class="" action="/admin/{{$course->id}}/course-details" method="post" enctype="multipart/form-data" name="form_edit_course" id="form_edit_course">
            @csrf
            @method('put')
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="course" class="col-md-4 control-label">Course</label>
                    <input type="text" name="course" id="course" 
                            placeholder="Enter Course" class="form-control"
                            value="{{ $course->course }}">  
                    @if ($errors->has('course')) 
                        <span class="text-danger">{{ $errors->first('course') }}</span> 
                    @endif
                </div>
            </div>
                <div class="col-md-4">
                    <button class="btn-primary" id="save" name="submit"> Save </button>
                </div>

                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif

        </form>
    @endforeach


<br>




@endsection
