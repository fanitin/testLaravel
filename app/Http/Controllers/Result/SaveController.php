<?php

namespace App\Http\Controllers\Result;

use App\Http\Requests\Result\SaveRequest;
use App\Models\Category;
use App\Models\Tag;

class SaveController extends BaseController{
    public function __invoke(SaveRequest $request){
        $data = $request->validated();
            try {
                $data = $this->service->save($data);
                return view('calc.index', ['data' => $data, 'categories' => Category::all(), 'tags' => Tag::all()]);

                /*foreach ($this->tag_id as $tag) {
                    ResultTag::firstOrCreate([
                        'result_id' => $result->id,
                         'tag_id' => $tag
                    ]);
                } to inny sposob, raczej go bede uzywal przy pisaniu projektu zaliczeniowego, bo też można dodac ilosc produktów np*/
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
    }
}
