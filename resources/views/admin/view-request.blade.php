@extends('admin/layout')


@section('Content')
    <h2>Book Request</h2><br>
    {{-- <div class="row"> --}}
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Book Title</th>
                    <th>Status</th>
                    <th class="">Action</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($request_book as $record)
                    <div class="flex">
                        <tr>
                            <td>{{$record->student->name}}</td>
                            <td>{{$record->book->title}}</td>
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
                            <td class="">
                                @if ($record->status == '2')
                                    <a class="fa fa-check "  value="approve" 
                                            onclick="approve('{{$record->id}}')"
                                            style="cursor:pointer; color:green">
                                    </a>
                                            &nbsp; &nbsp;
                                    <a class="fa fa-close" href="#"  value="decline"
                                            style="cursor:pointer; color:red"
                                            onclick="decline('{{$record->id}}')">
                                    </a>
                                @endif
                                        &nbsp; &nbsp;
                                <a class="fa fa-eye" 
                                    href="{{'/admin/'.$record->book_id.'/view-request-student/'.$record->student_id}}" 
                                    id="request-{{$record->book_id}}">
                                </a>
                            </td>

                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{$request_book->links()}}
        </div> 
    {{-- </div> --}}
    
    <form action="/admin/view-request/status"  method="POST" id="approve-decline-form">
        @csrf
        <input type="hidden" name="approve_decline"  id="approve-decline" value="">
        <input type="hidden" name="record_id" id="record-id" value="">
    </form>

@endsection

@section('script')
<script>

    function approve(id){
        $('#approve-decline').val('1');
        $('#record-id').val(id);

        $("#approve-decline-form").submit();
    }

    function decline(id) {
        $('#approve-decline').val('0');
        $('#record-id').val(id);

        $("#approve-decline-form").submit();

    }
</script>
@endsection


