@extends('layout')


@section('Content')
<div class="container col-4 text-white" style="padding-top: 50px">
    <h2>Book Management</h2>
    <br>
    <form class="form-horizontal" action="/login" method="post" name="form_login" id="form_login">
        @csrf
            <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email</label>
                <div class="col-md-10">
                    <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control">   
                </div>

                <label for="password" class="col-md-4 control-label">Password</label>
                <div class="col-md-10">
                    <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">   
                </div>
            </div>
            
            <div class="form-group">
                <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-sm-10">
                    <button class="btn-primary" id="login" name="login"> Login </button>
                    {{-- &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; --}}
                    <a href="register" style="color:white; padding-left: 75px;">Create account</a>
                </div>
            </div>
    </form>
    

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif 
</div>

@endsection

@section('script')
<script>
   $(function() 
   {
       $("#form_login").validate({			  
           rules: {
               email: {
                   required: true,
                   email: true
               },
               password:{
                   required: true,
                   minlength:5
               }
           },
           // Specify the validation error messages
           messages: 
           {
                email: {
                   required: "This field is required" 
               },
               password:{ 
                  required:'This field is required'
               }
           }
       });
    });
</script>
@endsection

