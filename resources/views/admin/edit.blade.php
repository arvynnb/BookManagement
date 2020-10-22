@extends('admin/layout')


@section('Content')
<h2>Edit Book</h2>
<form class="form-horizontal" action="/admin/{{$book->id}}/edit" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
        <div class="form-group">
            <label for="title" class="col-md-4 control-label">Title</label>
            <div class="col-md-4">
                <input type="text" name="title" id="title" placeholder="Enter Title" class="form-control" value="{{$book->title}}">  
                @if ($errors->has('title')) 
                    <span class="text-danger">{{ $errors->first('title') }}</span> 
                @endif 
            </div>

            <label for="author" class="col-md-4 control-label">Author</label>
            <div class="col-md-4">
                <input type="text" name="author" id="author" placeholder="Enter Author" class="form-control" value="{{$book->author}}">
                @if ($errors->has('author')) 
                    <span class="text-danger">{{ $errors->first('author') }}</span> 
                @endif  
            </div>

            <label for="description" class="col-md-4 control-label">Description</label>
            <div class="col-md-4">
            <textarea id="description" name="description" rows="4" cols="25" >{{$book->description}}</textarea>
            @if ($errors->has('description')) 
                <span class="text-danger">{{ $errors->first('description') }}</span> 
            @endif 
                {{-- <input type="text" name="description" id="description" placeholder="Enter Description" class="form-control" value="{{$book->description}}">    --}}
            </div>

            <label for="quantity" class="col-md-4 control-label">Quantity</label>
            <div class="col-md-4">
                <input type="text" name="quantity" id="quantity" 
                placeholder="Enter Quantity" class="form-control" value="{{$book->quantity}}"
                onkeypress="return isNumberKey(event)">
                @if ($errors->has('quantity')) 
                    <span class="text-danger">{{ $errors->get('quantity') }}</span> 
                @endif 
            </div>
        </div>

            <label for="image" class="col-md-4 control-label">Image</label>
            <div class="col-md-4">
                <input type="file" name="image" id="image" 
                        accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                <img id="output" alt="Book-Image"  width="100" height="100" src="{{ asset('/storage/images/'.$book->image)}}">
                @if ($errors->has('image')) 
                    <span class="text-danger">{{ $errors->first('image') }}</span> 
                @endif 
            </div>
            
        <div class="form-group">
            <label for="submit" class="col-md-4 control-label"></label>
            <div class="col-md-4">
                <button class="btn-primary" id="save" name="submit"> Update </button>
            </div>
        </div>

</form>
<br>
    <div>
        <a href="/admin"><button class="btn-primary"> Back </button></a>
    </div>
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
@endsection

@section('script')
    <script>
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
</script>
@endsection