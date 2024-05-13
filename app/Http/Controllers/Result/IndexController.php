<?php

namespace App\Http\Controllers\Result;
use App\Http\Filters\ResultFilter;
use App\Http\Requests\Result\FilterRequest;
use App\Models\Result;

class IndexController extends BaseController{
    public function __invoke(FilterRequest $filter){
        try {
            $data = $filter->validated();

            $filt = app()->make(ResultFilter::class, ['queryParams' => array_filter($data)]);
            $results = Result::filter($filt)->paginate(20);
            return view('result.index', ['records' => $results, 'data' => $data]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}