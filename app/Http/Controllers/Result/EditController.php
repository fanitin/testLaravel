<?php

namespace App\Http\Controllers\Result;
use App\Models\Result;
use App\Models\Category;
use App\Models\Tag;

class EditController extends BaseController{
    public function __invoke(Result $result){
        $categories = Category::all();
        $tags = Tag::all();
        return view('result.edit', ['result' => $result, 'categories' => $categories, 'tags' => $tags]);
    }
}
