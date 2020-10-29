<table class="table table-striped text-center" id="book_list">
    <thead>
        <tr>
            <th>Name</th>
            <th>Author</th>
            <th>Quantity</th>
            <th>Borrows</th>
            <th class="">Action</th>
        </tr>
    </thead>
    <tbody id="books" >
        @foreach ($books as $book)
            <div class="flex">
                <tr>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
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
<div class="d-flex justify-content-center" >
    {{$books->links()}}
</div> 

@section('script')
<script>
    $(function() {
        $(".pagination a").click(function() {
            return call_post_func($(this).attr('href'));
        });
    });
    function call_post_func(href)
    {
        console.log(href);
        post_this(href)
        return false;
    }
    </script>
@endsection