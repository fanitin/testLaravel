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

    public function operationDelete(Result $result){
        try{
            if($result->deleted_at == null){
                $result->delete();
            }
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('result.index');
    }


    
    public function operationSendToEdit(Result $result){
        return view('result.edit', ['result' => $result]);
    }


    public function operationEdit(Request $request){
        if (!$request->filled(['kwota', 'years', 'procent', 'phone'])) {
            return redirect()->back()->withErrors('Proszę wypełnić wszystkie pola.');
        }
        $request->validate([
            'kwota' => 'required|numeric',
            'years' => 'required|numeric',
            'procent' => 'required|numeric',
            'phone' => 'required|string|regex:/^\+48[0-9]{9}$/'
        ]);
        $id = $request->input('idEdit');
        $operation = Result::find($id);
        $operation->update([
            'kwota' => $request->input('kwota'),
            'years' => $request->input('years'),
            'procent' => $request->input('procent'),
            'wynik' => ($request->input('kwota') + ($request->input('kwota') * $request->input('proc')/100)) / ($request->input('years')*12),
            'data' => date('Y-m-d H:i:s'),
            'phone' => $request->input('phone')
        ]);
        return redirect()->route('result.index');
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
            return view('result.index', ['records' => $records, 'sortType' => $this->sortType, 'sortOrder' => $this->sortOrder, 'searchForm' => $this->searchForm]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Wystąpił błąd: ' . $e->getMessage());
        }
    }
}