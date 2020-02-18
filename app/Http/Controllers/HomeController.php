<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        if(!Auth::check()) {
            return view('landing');
        } else {
            if(Auth::user()->role == "customer") {
                return redirect('order');
            } else {
                return redirect('staff');
            }
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        if(Auth::user()->role == "customer") {
            return redirect('order');
        } else {
            return redirect('staff');
        }
    }

    public function staff()
    {
        if(!Auth::check()) { 
            return redirect('/');
        } else {
            if(Auth::user()->role == "customer") {
                return redirect('order');
            } else {
                return view('staff');
            }
        }
    }

    public function order() 
    {
        if(!Auth::check()) { 
            return redirect('/');
        } else {
            if(Auth::user()->role == "staff") {
                return redirect('staff');
            } else {
                return view('order');
            }
        }
    }

    public function preparation() 
    {
        if(!Auth::check()) { 
            return redirect('/');
        } else {
            if(Auth::user()->role == "customer") {
                return redirect('order');
            } else {
                return view('preparation');
            }
        }
    }

    public function payments()
    {
        if(!Auth::check()) { 
            return redirect('/');
        } else {
            if(Auth::user()->role == "customer") {
                return redirect('order');
            } else {
                return view('payments');
            }
        }
    }
}
