<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Forms\OperationEditForm;
use Illuminate\Support\Facades\DB;

class OperationEditController extends Controller{
    public $oeForm;
    private $searchForm;
    private $records;
    private $sort_type;
    private $sort_order;

    public function __construct(){
        $this->oeForm = new OperationEditForm();
    }

    public function operationSave(){
        try {
            $data = [
                'kwota' => $this->oeForm->kwota,
                'years' => $this->oeForm->years,
                'procent' => $this->oeForm->procent,
                'wynik' => $this->oeForm->wynik,
                'data' => $this->oeForm->data,
                'phone' => $this->oeForm->phone
            ];
            OperationEditForm::create($data);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function operationDelete($id){
        try{
            $us = OperationEditForm::find($id);
            $us->delete();
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('resultView');
    }


    public function operationList(Request $request){
        $searchForm = $request->input("searchForm");
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
            return view('/results', ['records' => $records, 'sortType' => $sortType, 'sortOrder' => $sortOrder, 'searchForm' => $searchForm]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}