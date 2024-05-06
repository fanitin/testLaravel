<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultTag;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;

class OperationEditController extends Controller{
    public $result;
    private $searchForm;
    private $records;
    private $sortType;
    private $sortOrder;
    public $cat_id;
    public $tag_id = array();

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
                'phone' => $this->result->phone,
                'category_id' => $this->cat_id
            ];
            $result = Result::create($data);
            $result->tags()->attach($this->tag_id);
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

    public function destroy(Result $result){
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('result.edit', ['result' => $result, 'categories' => $categories, 'tags' => $tags]);
    }


    public function edit(Request $request){
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
        $tags = $request->input('tags');
        $operation = Result::find($id);
        $operation->update([
            'kwota' => $request->input('kwota'),
            'years' => $request->input('years'),
            'procent' => $request->input('procent'),
            'wynik' => ($request->input('kwota') + ($request->input('kwota') * $request->input('proc')/100)) / ($request->input('years')*12),
            'phone' => $request->input('phone'),
            'category_id' => $request->input('category_id')
        ]);
        $operation->tags()->sync($tags);
        return redirect()->route('result.index');
    }

    public function index(Request $request){
        $this->searchForm = $request->input("searchForm");
        $this->sortType = $request->input("sortType");
        $this->sortOrder = $request->input("sortOrder");

        $query = Result::query();

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