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
    public function authlogin(Request $request)
    {
        // dd($hashed = Hash::make('qwerty'));
        $email =  $request->input('email');
        $password =  $request->input('password');
        if($email && $password)
        {
            
            if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1]))
            {
                // dd(Auth::user());
                $books = Book::withCount('borrows')->get();
                return redirect('/admin')->with('books',$books);

            }elseif(Auth::attempt(['email' => $email, 'password' => $password, 'role' => 0]))
            {
                // dd(Auth::user());
                $borrows = Borrow::select('book_id')->where('student_id',Auth::user()->student_id)->get()->pluck('book_id');
                $books = Book::withCount('borrows')->whereNotIn('id',$borrows)->get();
                return redirect('/student')->with('books',$books);
            
            }
        }
        return redirect()->back()->withErrors('Invalid Credentials');

    }

    public function logout(Request $request){
        Auth::logout();
        // dd(Auth::user());
        return redirect('/');
    }
}
