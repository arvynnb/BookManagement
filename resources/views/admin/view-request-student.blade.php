@extends('admin/layout')


@section('Content')
<h2>Request Details</h2>
                <ul>
                    <li>
                        Student Name: 
                    <span class="text-success" style="font-weight:900" id="student">{{$student->name}}</span>
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
                            @if ($book->image != '')
                                <img  src="{{ asset('/storage/images/'.$book->image)}}" alt="Book-Banner" style="width: 40%;">
                            @else
                            <img src="{{ asset('/storage/images/default-placeholder-image.png')}}" alt="Book-Banner" style="width: 40%;">
                            @endif
                        </span>
                    </li>
                </ul>
        <div>
            <a href="/admin/view-request"><button class="btn-primary"> Back </button></a>
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