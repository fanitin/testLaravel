<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class CalcController extends Controller{

    public function index(Request $request){
        $categories = Category::all();
        $tags = Tag::all();
        return view('calc.index', ['form' => $request->form, 'result' => $request->result, 'categories' => $categories, 'tags' => $tags]);
    }
}