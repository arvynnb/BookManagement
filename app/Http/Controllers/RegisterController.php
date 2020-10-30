<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Course;
use App\Models\student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('course')->get();
        return view('register')->with('courses',$courses);
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $course = $request->input('course');
        $password = $request->input('password');
        $confirm_password = $request->input('confirm_password');

        $user_email = User::where('email', '=', $email)->exists();

        if ($user_email) {
            return redirect()->back()->withErrors(
                [
                    'email' => ['Email is already use.']
                ]);
        }

        $validatedData = request()->validate([
            'name'             => 'required|string|max:30',
            'email'            => 'required|string|max:30',
            'course'           => 'required|string|max:30',
            'password'         => 'required|min:5|max:30',
            'confirm_password' => 'required|min:5|max:30'
            ]);

        if($password == $confirm_password)
        { 
            
            $user_id = User::select('id')->orderBy('id','DESC')->first();
            $student = Student::create([
                'name'      => $validatedData['name'],
                'course'    => $validatedData['course'],
                'user_id'   => $user_id->id + 1
            ]);

            User::create([
                'name'       => $validatedData['name'],
                'email'      => $validatedData['email'],
                'role'       => '0',
                'password'   => Hash::make($validatedData['password']),
                'student_id' => $student->id

            ]);


            return redirect()->back()->withSuccess('Successfully created');
        }
        else
        {
            return redirect()->back()->withErrors(
                [
                    'confirm_password' => ['Password not match.']
                ]);
        }
    }
}
