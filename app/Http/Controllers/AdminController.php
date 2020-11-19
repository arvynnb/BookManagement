<?php

namespace App\Http\Controllers;
use Auth;
use DataTables;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\File;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
// use Session;

class AdminController extends Controller
{
    public function index(Request $request)
    {   
            $books = Book::withCount('borrows')->orderBy('title','ASC')->get();
            return view('admin.index')->with('books',$books);
    }

    public function create(){
        return view('admin.createbook');
    }   

    public function store(Request $request)
    {
        $validatedData = request()->validate([
            'title'         => 'required|string|max:50',
            'author'        => 'required|string|max:50',
            'description'   => 'required|string|max:255',
            'quantity'      => 'required|numeric|min:0|max:1000',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

            $filename = $request->image->getClientOriginalName();        
            $request->image->storeAs('images',$filename,'public');     
            
            $book = Book::create([
                'title'         => $validatedData['title'],
                'author'        => $validatedData['author'],
                'description'   => $validatedData['description'],
                'quantity'      => $validatedData['quantity'],
                'image'         => $filename,
            ]);
            
            File::create([
                'name'      => $filename,
                'path'      => '/storage/images/',
                'model'     => 'Book',
                'source_id' => $book->id
            ]);
        
        return redirect()->back()->withSuccess('Book Added');
    }

    public function edit(Book $book, File $files)
    {
        $books = Book::withCount('borrows')->with('file')->where('id',$book->id)->get();
        return view('/admin/edit')->with('books',$books);
    }

    public function update(Request $request,Book $book, File $file)
    {
        $books    = Book::withCount('borrows')->where('id',$book->id)->get();
        $quantity = $request->input('quantity');
        $books    = Book::withCount('borrows')->where('id',$book->id)->get();
        $count    = 0;

        foreach ($books as $book_count) 
        {
            $count = $book_count->borrows_count;
        }

        if ($count >= $quantity) 
        {
           return redirect()->back()->with('books',$books)->withErrors('Book quantity invalid');
        }

        $validatedData = request()->validate([
            'title'       => 'required|string|max:50',
            'author'      => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'quantity'    => 'required|numeric|min:0|max:1000',
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

            if ($request->hasFile('image')) {
                $filename = $request->image->getClientOriginalName();
                $request->image->storeAs('images',$filename,'public'); 
                $book->update(
                    [
                       'image'       => $filename,
                       'title'       => $validatedData['title'],
                       'author'      => $validatedData['author'],
                       'description' => $validatedData['description'],
                       'quantity'    => $validatedData['quantity']
                    ]);
                    $file = DB::table('files')
                    ->where('source_id', $book->id)
                    ->update(['name' => $filename]);
                
            }else
            {
                $book->update($validatedData);
            }
        return redirect()->back()->with('books',$books)->withSuccess('Book Edited');
    }

    public function delete(Book $book)
    {
        $books = Book::withCount('borrows')->where('id',$book->id)->get();
        $count = 0;
        foreach ($books as $book_count) {
            $count = $book_count->borrows_count;
        }

        if($count == 0)
        {
            $book->delete();
            return redirect()->back()->withSuccess('Book Deleted');
        }
        else
        {
            return redirect()->back()->withErrors('Cannot delete this book');
        }

    }

    public function viewbook(Book $book)
    {
        $books = Book::select('title','author','description','quantity','image')
                       ->withCount('borrows')
                       ->with('file')
                       ->where('id',$book->id)->get();
        return view('/admin/view-book')->with('books',$books);
    }

    public function viewrequest(Book $book, Borrow $borrow, student $student)
    {
        $request_book = Borrow::select('id','status','book_id','student_id')
                                ->with('book:id,title')
                                ->with('student:id,name')
                                ->orderBy('status','DESC')
                                // ->get();
                                ->paginate(10);
        return view('/admin/view-request')->with('request_book',$request_book);  
    }

    public function viewrequest_student(Book $book, $student)
    {
        $student_request = Student::select('name')->where('user_id',$student)->first();
        $books = Book::select('title','author','description','quantity','image')
                        ->withCount('borrows')
                        ->where('id',$book->id)
                        ->first();
        return view('/admin/view-request-student')->with(['book' =>$books,'student'=> $student_request]);
    }

    public function approve_decline(Request $request,Borrow $borrows)
    {
        if ($request->approve_decline == 0) 
        {
            DB::table('borrows')
                ->where('id',$request->record_id)
                ->update([
                        'status'     => 0,
                        'declined_at'=>Carbon::now('Asia/Manila')
                ]);
            return redirect()->back();
        }
        else
        {
            DB::table('borrows')
                ->where('id',$request->record_id)
                ->update([
                            'status'     => 1,
                            'accepted_at'=>Carbon::now('Asia/Manila')
                        ]);
            return redirect()->back();
        }
    }


}
