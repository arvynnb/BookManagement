@extends('admin/layout')


@section('Content')

    <div class="col-md-4">
        <h2>Course List</h2><br>
    </div>
    <form class="" action="/admin/add-course" method="post" enctype="multipart/form-data" name="form_add_course" id="form_add_course">
        @csrf
        <div class="form-row">
            <div class="col-md-4">
                <input type="text" name="course" id="course" 
                        placeholder="Add Course" class="form-control"
                        value="{{ old('course') }}">  
                @if ($errors->has('course')) 
                    <span class="text-danger">{{ $errors->first('course') }}</span> 
                @endif
            </div>
            <div class="col-md-4">
                <button class="btn-primary" id="save" name="submit"> Save </button>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
   
    <br>
     <div class="table-responsive text-nowrap">    
        <table class="table table-striped table-hover text-center" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($courses as $course)
                            <div class="flex">
                                <tr>
                                    <td>{{$course->id}}</td>
                                    <td>{{$course->course}}</td>
                                    <td class="text-center">
                                        <a class="fa fa-edit" href="{{'/admin/'.$course->id.'/course-details'}}" id="course-{{$course->id}}">
                                    </td>
                                </tr>
                            </div>
                    @endforeach
                </tbody>

        </table>
    </div>
@endsection


