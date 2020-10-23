@extends('student/layout')


@section('Content')
        <h2>Book List</h2><br>
        {{-- {!!Session::get('student_id')!!} --}}
        <div class="row">
            <table class="table table-striped text-center">
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
                                    {{-- <td>{{$book->borrows}}</td> --}}
                                    {{-- <td>{{DB::table('borrows')->select('book_id')->where('book_id',$book->id)->get()}}</td> --}}
                                    <td>{{$book->title}}</td>
                                    <td>{{$book->author}}</td>
                                    <td>{{$book->quantity - $book->borrows_count}}</td>
                                    <td class="text-center">
                                        <a class="fa fa-eye" href="{{'/student/'.$book->id.'/single-view'}}" id="view-{{$book->id}}">
                                        &nbsp;
                                    </td>
                                </tr>
                            </div>
                        {{-- @endif --}}
                    @endforeach
                </tbody>
            </table>
@endsection


