@extends('admin/layout')


@section('Content')
<a href="/admin/student-list">Back</a>
<h2>Student Details</h2>
@foreach ($student_details as $student)
<form class="" action="/admin/{{$student->id}}/student-details" method="post" enctype="multipart/form-data" name="form_edit_student" id="form_edit_student">
    @csrf
    @method('put')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="title" class="col-md-4 control-label">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{$student->name}}">  
                @if ($errors->has('name')) 
                    <span class="text-danger">{{ $errors->first('name') }}</span> 
                @endif 
            </div>

        <div class="form-group col-md-6">
            <label for="author" class="col-md-4 control-label">Email</label>
            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" value="{{$student->user->email}}">
            @if ($errors->has('email')) 
                <span class="text-danger">{{ $errors->first('email') }}</span> 
            @endif  
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="username" class="cols-sm-2 control-label">Course</label>
            <div class="cols-sm-10">
                    <select class="form-control" name="course">
                        @foreach($courses as $course_list)
                        <option value="{{ $course_list->course }}" {{$student->course == $course_list->course  ? 'selected' : ''}}>{{ $course_list->course}}</option>
                          {{-- <option value="{{$course_list->course}}">{{$course_list->course}}</option> --}}
                        @endforeach
                    </select>
                    @if ($errors->has('course')) 
                        <span class="text-danger">{{ $errors->first('course') }}</span> 
                    @endif
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password" class="cols-sm-2 control-label">Password</label>
            <div class="cols-sm-10">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" value="{{ old('password') }}"/>
                    @if ($errors->has('password')) 
                        <span class="text-danger">{{ $errors->first('password') }}</span> 
                    @endif
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="confirm_password" class="cols-sm-2 control-label">Confirm Password</label>
            <div class="cols-sm-10">
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your Password" value="{{ old('confirm_password') }}" />
                    @if ($errors->has('confirm_password')) 
                        <span class="text-danger">{{ $errors->first('confirm_password') }}</span> 
                    @endif
            </div>
        </div>
    </div>

        <div class="col-md-4">
            <button class="btn-primary" id="submit" name="submit"> Update </button>
        </div>
    {{-- </div> --}}

    @if(session('success'))
        <div class="alert alert-success">
                {{session('success')}}
        </div>
    @endif 

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif 
</form>

    
@endforeach
<br>



@endsection


@section('script')
    <script>
        $(function() 
        {
            $("#form_edit_student").validate({			  
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    course:{ 
                        required:true,
                        // accept: "[a-zA-Z]+"
                    },
                    password:{
                        minlength:5,
                        required:true
                    },
                    confirm_password: {
                        equalTo: "#password",
                        required:true
                    }
                },

                // Specify the validation error messages
                messages: 
                {
                    name: {
                        required: 'This field is required'
                    },
                    email:{ 
                        required:'This field is required'
                    },
                    course: {
                        required: 'This field is required',
                        // accept: 'Letters only'
                    },
                    password:{
                        required: 'This field is required'
                    },
                    confirm_password:{
                        equalTo: 'Password not match'
                    }
                }
            });
        });
    </script>    
@endsection
