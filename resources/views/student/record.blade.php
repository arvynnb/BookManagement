@extends('student/layout')


@section('Content')
        <h2>Record List</h2><br>
        {{-- {!!Session::get('student_id')!!} --}}
        <div class="row">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Borrowed</th>
                        <th>Returned</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($borrow_book as $record)
                        <div class="flex">
                            <tr>
                                <td>{{$record->title}}</td>
                                <td>{{$record->author}}</td>
                                <td>
                                    @if ($record->status == '1')
                                        <span class="text-success">Accepted</span> 
                                    @elseif($record->status == '0')
                                        <span class="text-danger">Declined</span> 
                                    @elseif($record->status == '3')
                                        <span class="">Returned</span> 
                                    @else
                                        <span class="text-primary"> Pending</span>                                        
                                    @endif
                                </td>
                                <td>{{date('d-m-Y', strtotime($record->created_at))}}</td>
                                    @if ($record->returned_at)
                                        <td>{{date('d-m-Y', strtotime($record->returned_at))}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                
                                <td>
                                    @if ($record->status == '1')
                                    <span><a class="fas fa-backward"
                                            onclick="return_book('{{$record->id}}')"
                                            style="cursor:pointer">
                                            {{-- href="/student/record/book_returned" --}}
                                            {{-- id="return-id-{{$record->id}}" --}}
                                            </a></span>
                                    @endif
                                </td>
                                <td>
                                    <a class="fa fa-eye" 
                                        href="{{'/student/'.$record->id.'/request-details'}}" 
                                        id="">
                                    </a>
                                </td>
                                
                            </tr>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <form action="/student/record/book_returned"  method="POST" id="return-form">
                @csrf
                <input type="hidden" name="return_id"  id="return_book" value="">
                <input type="hidden" name="record_id" id="record-id" value="">
            </form>
@endsection

<script>
    function return_book(id){
        $('#return_book-decline').val('3');
        $('#record-id').val(id);

        $("#return-form").submit();
    }
</script>


