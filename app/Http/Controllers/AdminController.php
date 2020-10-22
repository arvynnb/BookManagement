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
use Illuminate\Support\Facades\Input;
// use Session;

class AdminController extends Controller
{


    public function create(){
        return view('admin.createbook');
    }   

    public function store(Request $request)
    {
        
        // dd($request->all());
        $validatedData = request()->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

                    $filename = $request->image->getClientOriginalName();        //get the original name of the image
                    $request->image->storeAs('images',$filename,'public');       //store image
                    // $this->deleteOldImage();                                     //delete old image
                    // Storage::delete('/public/images/'.$book->image);
                    // dd($filename);
                    Book::create([
                        'title' => $validatedData['title'],
                        'author' => $validatedData['author'],
                        'description' => $validatedData['description'],
                        'quantity' => $validatedData['quantity'],
                        'image' => $filename,
                    ]);
        
        return redirect()->back()->withSuccess('Book Added');
    }

    public function index()
    {
        // $books =  Book::all();
        // return view('admin.index',compact('books'));        
        $books = Book::withCount('borrows')->get();
        return view('admin.index')->with('books',$books);
    }

    public function edit(Book $book){
        // dd($book);
        // return view('/admin/edit')->with('book',$book);
        // $books = Book::withCount('borrows')->where('id',$book->id)->get();
        return view('/admin/edit')->with('book',$book);
    }

    public function update(Request $request,Book $book)
    {
        // $books = Book::withCount('borrows')->get();
        // dd($books->borrows_count);
        // $input = Input::only('quantity');   
        // $quantity = $input['quantity'];

        // if($quantity <= ($request->quantity))
        // {
        //     // dd('true');
        //     return redirect()->back()->withErrors('Invalid input of quantity');
        // }
        // else
        // {
            
        // }



        $validatedData = request()->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            ]);

            if ($request->hasFile('image')) {
                $filename = $request->image->getClientOriginalName();        //get the original name of the image
                $request->image->storeAs('images',$filename,'public');       //store image
                $book->update(['image'=>$filename]);                         //update query                           
            }

        
        $book->update($validatedData);
        return redirect()->back()->withSuccess('Book Edited');
        // dd($book);
        return redirect()->back();
    }

    public function delete(Book $book){
        $book->delete();
        return redirect()->back()->withSuccess('Book Deleted');
    }

    public function viewbook(Book $book)
    {
        $books = Book::withCount('borrows')->where('id',$book->id)->get();
        return view('/admin/view-book')->with('books',$books);
        // $book = Book::withCount('borrows')->get();
        // return view('admin.view-book')->with('book',$book);
    }

    public function viewrequest(Request $request, Borrow $borrows)
    {
        // $borrows = Borrow::all();
        // $books = Book::all();
        // $students = Student::all();

        $request = DB::table('borrows')
            ->join('students', 'borrows.student_id','=','students.student_id')
            ->join('books', 'borrows.book_id','=', 'books.id')
            ->select('students.first_name','students.last_name', 'books.title', 'borrows.id','borrows.status','book_id','borrows.student_id')
            ->orderBy('status','DESC')
            ->get();

        return view('/admin/view-request')->with(['request'=>$request]);  
    }

    public function viewrequest_student(Book $book)
    {
        $books = Book::withCount('borrows')->where('id',$book->id)->get();
        // $student = Student::with('book')->where('student_id',$borrow->student_id)->get();
        return view('/admin/view-request-student')->with('books',$books);
    }


    public function approve_decline(Request $request,Borrow $borrows){
        // dd($request->all());
        // return $request->approve_decline;


        if ($request->approve_decline == 0) {
            DB::table('borrows')
                ->where('id',$request->record_id)
                ->update([
                        'status' => 0,
                        'declined_at'=>Carbon::now('Asia/Manila')
                ]);
            return redirect()->back();
        }else{
            DB::table('borrows')
                ->where('id',$request->record_id)
                ->update([
                            'status' => 1,
                            'accepted_at'=>Carbon::now('Asia/Manila')
                        ]);
                
            // DB::table('books')
            //     // ->where('id',$request->record_id)
            //     ->decrement('quantity');

            return redirect()->back();
            // return 'accepted';
        }

    }




    public function logout(Request $request){
        $request->session()->forget('student_id');
        Auth::logout();
        // Session::flush();
        return view('index');

    }


    public function login(Request $request, Book $books, Student $students)
    {
        // $input = Input::only('email','password');   
        // $email = $input['email'];
        // $password = $input['password'];
        // $validatedData = request()->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        //     ]);

        // $check_row = Student::where('email', '=', Input::get('email'))->exists();

        // if ($validatedData ) {
        //     if ($check_row){
        //         $query = DB::table('students')
        //                     ->where('email', $email)
        //                     ->where('password', $password)
        //                     ->first();
                            
        //         // $db_password = $query->addSelect('password')->get();
        //         if (!isset($query->password)) {
        //             return 'invalid';
        //         }
        //         // dd($query->student_id);
        //         $db_password = $query->password;
        //         $db_role = $query->role;
        //         $db_student_id = $query->student_id;
        //         if ( $db_password == $password ) {
        //             // dd('success');
                                
        //             $request->session()->has('student_id');

        //             $request->session()->put('student_id',$db_student_id);

        //             $session_id = $request->session()->get('student_id');

        //             if ($db_role === 'admin') {
        //                 // dd('admin');
        //                 return redirect('/admin');
        //                 // $books =  Book::all();
        //                 // return view('/admin/index',compact('books'));
        //             }else{
                        
        //                 return redirect('/student');
        //                 // dd('student');
        //                 // $books =  Book::all();
        //                 // return view('/student/index',compact('books'));
        //             }
        //         }
        //     }else{
        //         return 'invalid email or password';
        //     }
        // }else{
        //     return 'invalid';
        // }

        // dd(Auth::user());
        // return Auth::users()->name;
        // $books =  Book::all();
        // return redirect('/admin');
        // return view('admin.index',compact('books'));
        // dd('test');
    }   

    
    // public function student_view(){
    //     $books =  Book::all();
    //     return view('/student/index',compact('books'));
    // }

    // public function admin_view(){
    //     $books =  Book::all();
    //     return view('/admin/index',compact('books'));
    // }
            

}
