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
                    <th></th>
                    <th>Course</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($courses as $course)
                            <div class="flex">
                                <tr>
                                    {{-- <td>{{$course->id}}</td> --}}
                                    <td></td>
                                    <td>{{$course->course}}</td>
                                    <td class="text-center">
                                        <a class="fa fa-edit" href="{{'/admin/'.$course->id.'/course-details'}}" id="course-{{$course->id}}">
                                            &nbsp; &nbsp; &nbsp;
                                        {{-- <a href="{{'/admin/course/'.$course->id.'/delete'}}">Delete</a> --}}
                                        <a href="#" class="fa fa-trash" onclick="delete_course('{{$course->id}}')"></a>
                                    </td>
                                </tr>
                            </div>
                    @endforeach
                </tbody>
        </table>
    </div>

    <div class="modal fade" id="delete-course" tabindex="-1" role="dialog" aria-labelledby="courseModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseModal"> Delete Confimation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="delete-form" method="post">
                    @csrf
                    @method('delete') 
                    <div class="modal-body">
                        <p>Are you sure?</p>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        function delete_course(id)
        {
            console.log(id);
            $("#delete-form").attr('action',`/admin/course/${id}/delete`);
            $("#delete-course").modal();
        }

        $(function() 
        {
            $("#form_add_course").validate({			  
                rules: {
                    course: {
                        accept: "[a-zA-Z]+"
                    },
                },
                // Specify the validation error messages
                messages: 
                {
                    course: {
                        accept: 'Letters only'
                    },
                }
            });
        });

    </script>
@endsection

