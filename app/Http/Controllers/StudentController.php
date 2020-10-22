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
    public function index(Book $books, Request $request)
    {
    //    dd( DB::table('borrows')
    //    ->where('book_id',$books->id)
    //    ->count());
        // $book_count = Student::withCount('borrows')->get();
        // dd($book_count);
        // $books =  Book::all();
        // return view('student.index',compact('books'))->with('book_count',$book_count);

        $books = Book::withCount('borrows')->get();
        return view('student.index')->with('books',$books);
    }

    public function singleview(Book $book)
    {
        $books = Book::withCount('borrows')->where('id',$book->id)->get();
        return view('/student/single-view')->with('books',$books);
        // return view('/student/single-view')->with('book',$book);
    }

    public function borrow(Request $request)
    {
        // $student_id = $request->session()->get('student_id');
        // dd($request->book_id);
        $student_id = Auth::user();
        DB::table('borrows')
            ->insert([
                'student_id' => $student_id->student_id,
                'book_id' => $request->book_id,
                'status' => '2',
                'created_at' => Carbon::now('Asia/Manila')
            ]);

        $books =  Book::get();
        // return view('student.index',compact('books'));
        return redirect('/student')->withSuccess('Request Sent');
        // return Borrow::all();


    }

    public function record(Request $request){
        
        // $session_id = $request->session()->get('student_id');
        // dd($session_id);
        $student_id = Auth::user()->student_id;
        $borrow_book = DB::table('borrows')
                            ->join('students', 'borrows.student_id','=','students.student_id')
                            ->join('books', 'borrows.book_id','=', 'books.id')
                            ->select('students.first_name', 'books.title', 'books.author',
                                    'borrows.status','borrows.id','borrows.created_at','borrows.returned_at')
                            ->orWhere('students.student_id',$student_id)
                            ->get();

        return view('/student/record')->with('borrow_book',$borrow_book);
    }

    public function book_returned(Request $request){
        // dd($request->all());
        // return $request->record_id;
        DB::table('borrows')
        ->where('id',$request->record_id)
        ->update([
                    'status' => 3,
                    'returned_at'=>Carbon::now('Asia/Manila')
                ]);
                return redirect()->back()->withSuccess('Book Returned');
    }

    public function request_details(Book $book, Borrow $borrow)
    {
        // $query = DB::table('borrows')->select('name');
        $borrow = Borrow::withCount('book')->first();
        // dd($borrow->book_id);
        $books = Book::withCount('borrows')->where('id',$borrow->book_id)->get();
        // dd($books);
        return view('/student/request-details')->with('books',$books);
    }

}
