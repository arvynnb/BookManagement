@extends('admin/layout')


@section('Content')
    <a href="/admin/createbook">Create Book</a>
        <h2>Book List</h2><br>
        {{-- {!!Session::get('student_id')!!} --}}

        <div class="row">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Author</th>
                        <th>Quantity</th>
                        <th class="">Action</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($books as $book)
                        <div class="flex">
                            <tr>
                                <td>{{$book->title}}</td>
                                <td>{{$book->author}}</td>
                                <td>{{$book->quantity - $book->borrows_count}}</td>
                                {{-- <td>
                                    <img src="{{ asset('/storage/images/'.$book->image)}}" alt="" style="width: 40%;">
                                </td> --}}

                                <td class="">
                                    {{-- <a class="fa fa-eye" href="#"
                                        data-toggle="modal" data-target="#exampleModalLong"
                                        id="view-{{$book->id}}"
                                        onclick="view-{{$book->id}}"
                                        data-button='{
                                            "id": "{{$book->id}}",
                                            "title": "{{$book->title}}",
                                            "author": "{{$book->author}}",
                                            "description": "{{$book->description}}",
                                            "quantity": "{{$book->quantity}}",
                                            "image": "{{$book->image}}"
                                        }'
                                        >
                                    </a>   --}}

                                    <a class="fa fa-eye" href="{{'admin/'.$book->id.'/view-book'}}" id="view-{{$book->id}}">
                                    
                                    <a href="{{'admin/'.$book->id.'/edit'}}" class="fa fa-edit"></a>


                                    <a href="" class="fa fa-trash"
                                        data-toggle="modal" data-target="#delete"
                                        {{-- onclick="event.preventDefault();
                                        if(confirm('Are you really to delete?'))
                                        {
                                            document.getElementById('form-delete-{{$book->id}}')
                                            .submit()
                                        }" --}}
                                        >
                                    </a>
                                    <form action="{{'admin/'.$book->id.'/delete'}}" 
                                        id="form-delete-{{$book->id}}" 
                                        method="post" 
                                        style="display: none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

<!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Delete Confimation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="document.getElementById('form-delete-{{$book->id}}')
                .submit()">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>





<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Launch demo modal
</button>
--}}
<!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Book Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                {{-- @foreach ($books as $book) --}}
                    <ul>
                        <li>
                            Book Title: <span style="font-weight:900" id="title">{{$book->title}}</span>
                        </li>
                        <li>
                            Author: <span style="font-weight:900" id="author">{{$book->author}}</span>
                        </li>
                        <li>
                            Description: <span style="font-weight:900" id="description">{{$book->description}}</span>
                        </li>
                        <li>
                            Quantity: <span style="font-weight:900" id="quantity">{{$book->quantity}}</span>
                        </li>
                        <li>
                            Image Banner: <span style="font-weight:900" id="image" >
                                <img  src="{{ asset('/storage/images/'.$book->image)}}" alt="Book-Banner" style="width: 40%;">
                            </span>
                        </li>
                    </ul>
                {{-- @endforeach --}}
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
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




        function view(id) {
            var data = JSON.parse($(`#view-${id}`).data().button);
        // console.log(data);
        }

        $(`#view-3`).click(function(){
        // var data = $.parseJSON($(this).attr('data-button'));
        var data = $(this).attr('data-button');
        var value =$.parseJSON(data);
        
        var id_modal = $('#id').text(value.id);
        $('#title').text(value.title);
        $('#author').text(value.author);
        $('#description').text(value.description);
        $('#quantity').text(value.quantity);
        // var image_banner = {{ asset('/storage/images/'.$book->image)}}
        $('#image').text(value.image);
        console.log(value);
        });
    </script>
@endsection

