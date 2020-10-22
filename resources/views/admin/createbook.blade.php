@extends('admin/layout')


@section('Content')
<h2>Add Book</h2><br>


<form class="form-horizontal" action="/admin/createbook" method="post" enctype="multipart/form-data" >
    @csrf
                <div class="form-group justify-content-center">
                    <label for="title" class="col-md-4 control-label">Title</label>
                    <div class="col-md-4">
                        <input type="text" name="title" id="title" 
                                placeholder="Enter Title" class="form-control"
                                value="{{ old('title') }}">  
                        @if ($errors->has('title')) 
                            <span class="text-danger">{{ $errors->first('title') }}</span> 
                        @endif
                    </div>

                    <label for="author" class="col-md-4 control-label">Author</label>
                    <div class="col-md-4">
                        <input type="text" name="author" id="author" 
                                placeholder="Enter Author" class="form-control"
                                value="{{ old('author') }}">
                            @if ($errors->has('author')) 
                                <span class="text-danger">{{ $errors->first('author') }}</span> 
                            @endif
                    </div>

                    <label for="description" class="col-md-4 control-label">Description</label>
                    <div class="col-md-4">
                        {{-- <input type="text" name="description" id="description" 
                                placeholder="Enter Description" class="form-control"
                                value="{{ old('description') }}">    --}}
                            <textarea id="description" name="description" 
                                        rows="4" cols="25" >{{ old('description') }}
                            </textarea>
                            @if ($errors->has('description')) 
                                <span class="text-danger">{{ $errors->first('description') }}</span> 
                            @endif
                    </div>

                    <label for="quantity" class="col-md-4 control-label">Quantity</label>
                    <div class="col-md-4">
                        <input type="text" name="quantity" id="quantity" 
                                placeholder="Enter Quantity" class="form-control"
                                onkeypress="return isNumberKey(event)"
                                value="{{ old('quantity') }}">    
                            @if ($errors->has('quantity')) 
                                <span class="text-danger">{{ $errors->first('quantity') }}</span> 
                            @endif
                    </div>

                    <label for="image" class="col-md-4 control-label">Image</label>
                    <div class="col-md-4">
                        <input type="file" name="image" id="image"
                            accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])"value="{{ old('image') }}">
                            <img name="output" id="output" alt="Book-Image"  width="100" height="100" value="{{ old('output') }}" >
                            @if ($errors->has('image'))
                            {{-- @foreach ($errors->all() as $error) --}}
                                <span class="text-danger">{{$errors->first('image')}}</span>
                            {{-- @endforeach --}}
                            @endif 
                    </div>
                </div>
                <div class="form-group">
                    <label for="submit" class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button class="btn-primary" id="save" name="submit"> Save </button>
                    </div>
                </div>
</form>
<br>
    <div>
        <a href="/admin"><button class="btn-primary"> Back </button></a>
    </div>
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> --}}
{{-- @else 
    <div class="alert alert-success">
        <ul>Book Added</ul>
    </div> --}}
{{-- @endif  --}}
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