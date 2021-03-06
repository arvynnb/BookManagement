@extends('admin/layout')


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
                        Quantity: <span style="font-weight:900" id="quantity">{{$book->quantity}}</span>
                    </li>
                    <li>
                        Borrows: <span style="font-weight:900" id="quantity">{{$book->borrows_count }}</span>
                    </li>
                    <li>
                        Image Banner: <span style="font-weight:900" id="image" >
                            @if ($book->image != '')
                                <img  src="{{ asset('/storage/images/'.$book->image)}}" alt="Book-Banner" style="width: 40%;">
                            @else 
                                <img src="{{ asset('/storage/images/default-placeholder-image.png')}}" alt="Book-Banner" style="width: 40%;">
                            @endif
                        </span>
                    </li>
                </ul>
            @endforeach
        <div>
            <a href="/admin"><button class="btn-primary"> Back </button></a>
        </div>
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