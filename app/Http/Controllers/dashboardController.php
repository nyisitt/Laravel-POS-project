<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class dashboardController extends Controller
{
    //Admin user page divide section
    public function dashboard(){
        if(Auth::user()->suspend == 0){
            if(Auth::user()->role == 'admin'){

                return redirect()->route('category#listpage');
            }
            return redirect()->route('user#home');
        }
        Session::flush();
        return redirect()->route('auth#login')->with(['message' => "Your account is Ban Status !"]);



    }
}
