<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function filter_search(Request $request, Book $book)
    {
        $search_bar = $request->input('search');
        $borrows = Borrow::where('student_id',Auth::user()->student_id)->get()->pluck('book_id');
        $books = [];
        if ($search_bar != '') {
            $books = Book::withCount('borrows')
                            ->orWhere('title','LIKE', "%{$search_bar}%")
                            ->orWhere('author','LIKE', "%{$search_bar}%")
                            ->paginate(10);
                            
            if(Auth::user()->role == 1)
            {
                return view('admin.index')->with('books',$books);
            }else
            {
                return view('student.index')->with('books',$books);
            }
        }

        if(Auth::user()->role == 1)
        {
            $books = Book::withCount('borrows')->orderBy('title','ASC')->paginate(10);
            return view('admin.index')->with('books',$books);
        }
            $books = Book::withCount('borrows')->whereNotIn('id',$borrows)->orderBy('title','ASC')->paginate(10);
            return view('student.index')->with('books',$books);

    }
}
