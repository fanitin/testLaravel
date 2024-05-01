<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationEditController extends Controller{
    public $result;
    private $searchForm;
    private $records;
    private $sortType;
    private $sortOrder;

    public function __construct(){
        $this->result = new Result();
    }

    public function operationSave(){
        try {
            $data = [
                'kwota' => $this->result->kwota,
                'years' => $this->result->years,
                'procent' => $this->result->procent,
                'wynik' => $this->result->wynik,
                'data' => $this->result->data,
                'phone' => $this->result->phone
            ];
            Result::create($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function operationDelete($id){
        try{
            $us = Result::find($id);
            $us->delete();
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('resultView');
    }


    public function operationList(Request $request){
        $this->searchForm = $request->input("searchForm");
        $this->sortType = $request->input("sortType");
        $this->sortOrder = $request->input("sortOrder");

        $query = DB::table('results');

        if (!empty($this->searchForm)) {
            $query->where('phone', 'like', "%$this->searchForm%");
        }

        if (!empty($this->sortType) && !empty($this->sortOrder)) {
            $query->orderBy($this->sortType, $this->sortOrder);
        }

        try {
            $records = $query->get();
            return view('/results', ['records' => $records, 'sortType' => $this->sortType, 'sortOrder' => $this->sortOrder, 'searchForm' => $this->searchForm]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}