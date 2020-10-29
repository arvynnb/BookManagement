<?php

namespace App\Http\Controllers;
use Auth;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Book $book, Request $request)
    {
        $borrows = Borrow::where('student_id',Auth::user()->student_id)->get()->pluck('book_id');
        $books = Book::select('id','title','author','quantity')
                       ->withCount('borrows')
                       ->whereNotIn('id',$borrows)
                       ->orderBy('title','ASC')
                       ->paginate(10);
        return view('student.index')->with('books',$books);
    }

    public function singleview(Book $book)
    {
        $books = Book::select('id','title','author','description','quantity','image')
                       ->withCount('borrows')
                       ->where('id',$book->id)
                       ->get();
        return view('/student/single-view')->with('books',$books);
    }

    public function borrow(Request $request)
    {
        // $student_id = $request->session()->get('student_id');
        $student_id = Auth::user();

        DB::table('borrows')
            ->insert([
                'student_id' => $student_id->student_id,
                'book_id'    => $request->book_id,
                'status'     => '2',
                'created_at' => Carbon::now('Asia/Manila')
            ]);

        $books =  Book::get();
        return redirect('/student')->withSuccess('Request Sent');
    }

    public function record(Request $request)
    { 
        // $session_id = $request->session()->get('student_id');
        $student_id = Auth::user()->student_id;
        $borrow_book = Borrow::select('id','status','book_id','student_id','created_at','returned_at')
                                ->with('book:id,title,author')
                                ->where('student_id',$student_id)
                                ->orderBy('status','DESC')
                                ->paginate(10);

        return view('/student/record')->with('borrow_book',$borrow_book);
    }

    public function book_returned(Request $request)
    {
        DB::table('borrows')
        ->where('id',$request->record_id)
        ->update([
                    'status'        => 3,
                    'returned_at'   =>Carbon::now('Asia/Manila')
                ]);
        return redirect()->back()->withSuccess('Book Returned');
    }

    public function request_details(Book $book, Borrow $borrow)
    {
        $books = Book::where('id',$borrow->book_id)
                        ->withCount('borrows')
                        ->with('borrows:book_id,created_at')
                        ->get();
        return view('/student/request-details')->with('books',$books);
    }

}
