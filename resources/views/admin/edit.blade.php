@extends('admin/layout')


@section('Content')
<a href="/admin">Back</a>
<h2>Edit Book</h2>
@foreach ($books as $book)
<form class="" action="/admin/{{$book->id}}/edit" method="post" enctype="multipart/form-data" name="form_edit_book" id="form_edit_book">
    @csrf
    @method('put')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="title" class="col-md-4 control-label">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter Title" class="form-control" value="{{$book->title}}">  
                @if ($errors->has('title')) 
                    <span class="text-danger">{{ $errors->first('title') }}</span> 
                @endif 
            </div>

        <div class="form-group col-md-6">
            <label for="author" class="col-md-4 control-label">Author</label>
            <input type="text" name="author" id="author" placeholder="Enter Author" class="form-control" value="{{$book->author}}">
            @if ($errors->has('author')) 
                <span class="text-danger">{{ $errors->first('author') }}</span> 
            @endif  
        </div>
    </div>

    
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="quantity" class="col-md-4 control-label">Quantity</label>
            <input type="text" name="quantity" id="quantity" 
            placeholder="Enter Quantity" class="form-control" value="{{$book->quantity}}"
            onkeypress="return isNumberKey(event)">
            @if ($errors->has('quantity')) 
                <span class="text-danger">{{ $errors->get('quantity') }}</span> 
            @endif 
        </div>
        <div class="form-group col-md-6">
            <label for="image" class="col-md-4 control-label">Image</label>
            <input type="file" name="image" id="image" 
                    accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
        </div>
    </div>
        
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="description" class="col-md-4 control-label">Description</label>
            <textarea id="description" name="description" rows="4" cols="25" >{{$book->description}}</textarea>
            @if ($errors->has('description')) 
                <span class="text-danger">{{ $errors->first('description') }}</span> 
            @endif 
        </div>

        <div class="form-group col-md-6">
            <img id="output" alt="Book-Image"  width="200" height="200" src="{{ asset('/storage/images/'.$book->image)}}">
            {{-- src="{{ asset('/storage/images/'.$book->image)}}"> --}}
            @if ($errors->has('image')) 
                <span class="text-danger">{{ $errors->first('image') }}</span> 
            @endif 
        </div>
        <div class="col-md-4">
            <button class="btn-primary" id="save" name="submit"> Update </button>
        </div>
    </div>

</form>

    
@endforeach
<br>
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

        $(function() 
        {
            $("#form_edit_book").validate({			  
                rules: {
                    title: {
                        required: true
                    },
                    author: {
                        required: true
                    },
                    quantity: {
                        required: true,
                        accept: "[0-9]+",
                        max: 1000
                    },
                    description: {
                        required: true
                    },
                    image: {
                        required: true,
                        accept: "jpg|jpeg|png|gif"
                    }
                },

                // Specify the validation error messages
                messages: 
                {
                    title: {
                        required: 'This field is required'
                    },
                    author: {
                        required: 'This field is required'
                    },
                    quantity: {
                        required: 'This field is required',
                        accept: 'Number only'
                    },
                    description: {
                        required: "This field is required"
                    }
                }
            });
        });
</script>
@endsection