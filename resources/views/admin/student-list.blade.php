@extends('admin/layout')


@section('Content')
    <div class="form-row">
        <div class="col-md-6">
            <h2>Student List</h2><br>
            <a href="/admin/student-list/export">Export</a>
        </div>
        {{-- <div class="col-md-6">
            <form action="/admin/student-details/search" method="get" class="form-inline d-flex justify-content-center md-form form-sm">
                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="Search"
                        aria-label="Search" name="search_student" id="search_student"> 
                <i class="fas fa-search" aria-hidden="true"></i>
            </form>
        </div> --}}
    </div>
    {{-- <div class="row"> --}}
    <div class="table-responsive text-nowrap">    
        <table class="table table-striped table-hover text-center" >
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($students as $student)
                        {{-- @if ($book->id != DB::table('borrows')->select('book_id')->where('book_id',$book->id)->first() ) --}}
                            <div class="flex">
                                <tr>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->course}}</td>
                                    <td>{{$student->user->email}}</td>
                                    <td class="text-center">
                                        <a class="fa fa-eye" href="{{'/admin/'.$student->id.'/student-details'}}" id="student-{{$student->id}}">
                                    </td>
                                </tr>
                            </div>
                        {{-- @endif --}}
                    @endforeach
                </tbody>

        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{$students->links()}}
    </div> 
@endsection


