@extends('layout')

@section('Content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding-top: 5%">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="/register" name="form_register" id="form_register">
                            @csrf
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="name" class="cols-sm-2 control-label">Name</label>
                                    <div class="cols-sm-10">
                                        {{-- <div class="input-group"> --}}
                                            {{-- <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span> --}}
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name" value="{{ old('name') }}" />
                                        {{-- </div> --}}
                                            @if ($errors->has('name')) 
                                                <span class="text-danger">{{ $errors->first('name') }}</span> 
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="email" class="cols-sm-2 control-label">Email</label>
                                    <div class="cols-sm-10">
                                        {{-- <div class="input-group"> --}}
                                            {{-- <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span> --}}
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" value="{{ old('email') }}"/>
                                        {{-- </div> --}}
                                            @if ($errors->has('email')) 
                                                <span class="text-danger">{{ $errors->first('email') }}</span> 
                                            @endif
                                    </div>
                                </div>
                            </div>

                                
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="username" class="cols-sm-2 control-label">Course</label>
                                    <div class="cols-sm-10">
                                        {{-- <div class="input-group"> --}}
                                            {{-- <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span> --}}
                                            <input type="text" class="form-control" name="course" id="course" placeholder="Enter your Course" value="{{ old('course') }}" />
                                        {{-- </div> --}}
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
                                        {{-- <div class="input-group"> --}}
                                            {{-- <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span> --}}
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" value="{{ old('password') }}"/>
                                        {{-- </div> --}}
                                            @if ($errors->has('password')) 
                                                <span class="text-danger">{{ $errors->first('password') }}</span> 
                                            @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm_password" class="cols-sm-2 control-label">Confirm Password</label>
                                    <div class="cols-sm-10">
                                        {{-- <div class="input-group"> --}}
                                            {{-- <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span> --}}
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your Password" value="{{ old('confirm_password') }}" />
                                        {{-- </div> --}}
                                            @if ($errors->has('confirm_password')) 
                                                <span class="text-danger">{{ $errors->first('confirm_password') }}</span> 
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                            <div class="login-register">
                                <a href="index.php">Login</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
            {{session('success')}}
    </div>
    @endif
@endsection

@section('script')
    <script>
        $(function() 
        {
            $("#form_register").validate({			  
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    course:{ 
                        // required:true,
                        accept: "[a-zA-Z]+"
                    },
                    password:{
                        minlength:5
                    },
                    confirm_password: {
                        equalTo: "#password"
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
                        accept: 'Letters only'
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
