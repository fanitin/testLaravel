<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Result;

class IndexController extends Controller{
    public function __invoke(){
        $results = Result::paginate(20);
        return view('layouts.admin', ['results' => $results]);
    }
}