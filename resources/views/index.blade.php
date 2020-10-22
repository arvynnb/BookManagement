@extends('layout')


@section('Content')
<div class="container col-4">
    <h2>Book Management</h2>
    <br>
    <form class="form-horizontal" action="/login" method="post">
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
                <div class="col-md-4">
                    <button class="btn-primary" id="save" name="submit"> Login </button>
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
{{-- @else 
    <div class="alert alert-success">
        <ul>Book Added</ul>
    </div> --}}
@endif 
</div>

@endsection

