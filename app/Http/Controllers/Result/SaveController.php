<?php

namespace App\Http\Controllers\Result;

use App\Http\Requests\Result\SaveRequest;
use App\Models\Category;
use App\Models\Tag;

class SaveController extends BaseController{
    public function __invoke(SaveRequest $request){
        $data = $request->validated();
        $data = $this->service->save($data);
        return view('calc.index', ['data' => $data, 'categories' => Category::all(), 'tags' => Tag::all()]);
    }
}
