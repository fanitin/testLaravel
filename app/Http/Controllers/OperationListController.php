<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationListController extends Controller
{
    private $searchForm;
    private $records;
    private $sort_type;
    private $sort_order;


    public function operationList(Request $request)
    {
        $searchForm = $request->input("search_form");
        $sortType = $request->input("sort_type");
        $sortOrder = $request->input("sort_order");

        $query = DB::table('main');

        if (!empty($searchForm)) {
            $query->where('phone', 'like', "%$searchForm%");
        }

        if (!empty($sortType) && !empty($sortOrder)) {
            $query->orderBy($sortType, $sortOrder);
        }

        try {
            $records = $query->get();
            return view('/results', ['records' => $records, 'sortType' => $sortType, 'sortOrder' => $sortOrder]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}