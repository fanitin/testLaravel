<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\User;

class IndexController extends Controller{
    public function __invoke(){
        return view('layouts.admin');
    }
}