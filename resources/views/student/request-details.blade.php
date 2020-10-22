@extends('student/layout')


@section('Content')
                <h2>Request Details</h2>

            @foreach ($books as $book)
                <ul>
                    <li>
                        Request Date: <span style="font-weight:900" id="request_date">{{date('d-m-Y', strtotime($book->created_at))}}</span>
                    </li>
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
            <a href="/student/record"><button class="btn-primary text-right"> Back </button></a>
        </div>
<br>
@endsection