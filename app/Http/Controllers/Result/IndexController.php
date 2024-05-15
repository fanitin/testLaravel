<?php

namespace App\Http\Controllers\Result;
use App\Http\Filters\ResultFilter;
use App\Http\Requests\Result\FilterRequest;
use App\Http\Resources\Result\ResultResource;
use App\Models\Result;

class IndexController extends BaseController{
    public function __invoke(FilterRequest $filter){
        $data = $filter->validated();
        $page = $data['page'] ?? 1;
        $perPage = $data['perPage'] ?? 10;

        $filt = app()->make(ResultFilter::class, ['queryParams' => array_filter($data)]);
        $results = Result::filter($filt)->paginate($perPage, ['*'], 'page', $page);

        return ResultResource::collection($results);
        #return view('result.index', ['records' => $results, 'data' => $data]);
    }
}