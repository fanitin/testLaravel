<?php

namespace App\Http\Controllers\Result;
use App\Models\Result;
use Illuminate\Http\Request;

class IndexController extends BaseController{
    public function __invoke(REQUEST $request){
        $searchForm = $request->input("searchForm");
        $sortType = $request->input("sortType");
        $sortOrder = $request->input("sortOrder");

        $query = Result::query();

        if (!empty($searchForm)) {
            $query->where('phone', 'like', "%$searchForm%");
        }

        if (!empty($sortType) && !empty($sortOrder)) {
            $query->orderBy($sortType, $sortOrder);
        }

        try {
            $records = $query->get();
            return view('result.index', ['records' => $records, 'sortType' => $sortType, 'sortOrder' => $sortOrder, 'searchForm' => $searchForm]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}
