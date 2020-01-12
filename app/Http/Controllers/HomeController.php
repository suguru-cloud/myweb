<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//追記
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //追記
        $user = Auth::user()->role;
        
        return view('home', ['user' => $user]);
    }
}
