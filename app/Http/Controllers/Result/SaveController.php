<?php

namespace App\Http\Controllers\Result;

use App\Http\Requests\Result\SaveRequest;
use App\Http\Resources\Result\ResultResource;
use App\Models\Category;
use App\Models\Tag;

class SaveController extends BaseController{
    public function __invoke(SaveRequest $request){
        $data = $request->validated();
        $result = $this->service->save($data);

        return view('calc.index', ['data' => $result, 'categories' => Category::all(), 'tags' => Tag::all()]);
    }
}
