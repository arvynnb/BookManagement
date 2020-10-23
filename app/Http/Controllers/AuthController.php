<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authlogin(Request $request){

        // $user = Auth::user()->role;
        // dd($hashed = Hash::make('student'));
        // dd($hashed = Hash::make('admin'));
        // dd($hashed = Hash::make('qwerty'));
            // return $hashed = Hash::make('student1');
        // $credentials = $request->only('email', 'password');
        $input = Input::only('email','password');   
        $email = $input['email'];
        $password = $input['password'];
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1]))
        {
            // $books =  Book::all();
            // return view('/admin/index',compact('books'));
            $books = Book::withCount('borrows')->get();
            return view('admin.index')->with('books',$books);

        }elseif(Auth::attempt(['email' => $email, 'password' => $password, 'role' => 0])){
            // $book_count = Student::withCount('borrows')->get();
            // $books =  Book::all();
            // return view('student.index',compact('books'))->with('book_count',$book_count);
            // $books = Book::withCount('borrows')->get();
            
            $borrows = Borrow::where('student_id',Auth::user()->student_id)->get()->pluck('book_id');
            $books = Book::withCount('borrows')->whereNotIn('id',$borrows)->get();
            // dd($books);
            return view('student.index')->with('books',$books);
        }else{
            return redirect()->back()->withErrors('Invalid Credentials');
        }

    }
}
