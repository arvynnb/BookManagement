<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    
    public function logout(Request $request){
        Auth::logout();
        // dd(Auth::user());
        return redirect('/');
    }
}
