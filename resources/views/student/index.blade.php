@extends('student/layout')


@section('Content')
    <div class="form-row">
        <div class="col-md-6">
            <h2>Book List</h2><br>
        </div>
        <div class="col-md-6">
            <form action="/student/search" method="get" class="form-inline d-flex justify-content-center md-form form-sm">
                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search"
                        aria-label="Search" name="search" id="search"> 
                <i class="fas fa-search" aria-hidden="true"></i>
            </form>
        </div>
    </div>
    {{-- <div class="row"> --}}
    <div class="table-responsive text-nowrap">    
        <table class="table table-striped table-hover text-center" >
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($books as $book)
                        {{-- @if ($book->id != DB::table('borrows')->select('book_id')->where('book_id',$book->id)->first() ) --}}
                            <div class="flex">
                                <tr>
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->author}}</td>
                                    <td>{{$book->quantity - $book->borrows_count}}</td>
                                    <td class="text-center">
                                        <a class="fa fa-eye" href="{{'/student/'.$book->id.'/single-view'}}" id="view-{{$book->id}}">
                                    </td>
                                </tr>
                            </div>
                        {{-- @endif --}}
                    @endforeach
                </tbody>

        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{$books->links()}}
    </div> 
@endsection


