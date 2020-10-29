@extends('admin/layout')


@section('Content')
<a href="/admin/createbook">Create Book</a>
    <div class="form-row">
        <div class="col-md-6">
            <h2>Book List</h2><br>
        </div>
        {{-- <div class="col-md-6">
            <form action="/admin/search" method="get" class="form-inline d-flex justify-content-center md-form form-sm">
                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search"
                        aria-label="Search" name="search" id="search"> 
                <i class="fas fa-search" aria-hidden="true"></i>
            </form>
        </div> --}}
    </div>

        {{-- <div class="row"> --}}
        {{-- <table class="table table-striped text-center" id="book_list"> --}}
        <div class="table-responsive text-nowrap">
            <table id="book_list" class="table table-hover text-center" cellspacing="0" width="100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]">
            <thead>
                <tr>
                    <th hidden></th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th>Borrows</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="books" >
                @foreach ($books as $book)
                    <div class="flex">
                        <tr>
                            <td hidden></td>
                            <td class="">{{$book->title}}</td>
                            <td >{{$book->author}}</td>
                            <td>{{$book->quantity}}</td>
                            <td>{{ $book->borrows_count}}</td>
                            <td class="">
                                <a class="fa fa-eye" href="{{'/admin/'.$book->id.'/view-book'}}" id="view-{{$book->id}}">
                                <a href="{{'/admin/'.$book->id.'/edit'}}" class="fa fa-edit"></a>
                                <a href="#" class="fa fa-trash" onclick="delete_book('{{$book->id}}')"></a>
                            </td>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
        {{-- <div class="d-flex justify-content-center" >
            {{$books->links()}}
        </div>  --}}
    
    {{-- </div> --}}
    

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

@endsection

@section('script')
    <script>
        function delete_book(id)
        {
            console.log(id);
            $("#delete-form").attr('action',`admin/${id}/delete`);
            $("#delete").modal();
        }

        $(document).ready(function() {
            $('#book_list').dataTable( {
                autoWidth: false,
                "sPaginationType": "full_numbers",
            } );
        } );

        // $(document).ready(function()
        // {
        //     $("#search").keyup(function(event) {
        //         var value = $(this).val().toLowerCase();
        //         $("#books tr").filter(function() {
        //             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //         });
        //     });
        // });
    </script>
@endsection

