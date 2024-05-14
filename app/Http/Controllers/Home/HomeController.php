<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Controller;

class HomeController extends Controller{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function home(){
        return view('home.index');
    }
}
