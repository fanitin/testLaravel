<?php

namespace App\Http\Controllers\Admin\Result;

use App\Http\Controllers\Controller;
use App\Http\Filters\ResultFilter;
use App\Http\Requests\Result\FilterRequest;
use App\Models\Result;

class IndexController extends Controller{
    public function __invoke(FilterRequest $filter){
        try {
            $data = $filter->validated();

            $filt = app()->make(ResultFilter::class, ['queryParams' => array_filter($data)]);
            $results = Result::filter($filt)->paginate(20);
            return view('admin.result.index', ['results' => $results, 'data' => $data]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}