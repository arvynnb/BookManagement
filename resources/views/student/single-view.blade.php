@extends('student/layout')


@section('Content')
                <h2>Book Details</h2>

                @foreach ($books as $book)
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
                        Quantity: <span style="font-weight:900" id="quantity">{{$book->quantity - $book->borrows_count }}</span>
                    </li>
                    <li>
                        Image Banner: <span style="font-weight:900" id="image" >
                            <img  src="{{ asset('/storage/images/'.$book->image)}}" alt="Book-Banner" style="width: 40%;">
                        </span>
                    </li>
                </ul>
            @endforeach

        <div>
            <form action="/student" method="post"> 
                <input type="hidden" name="book_id" value="{{$book->id}}" >
                @csrf
                <button class="btn-success"> Borrow </button>
            </form>
            <a href="/student"><button class="btn-primary text-right"> Back </button></a>
        </div>

<br>

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