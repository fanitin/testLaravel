<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Forms\CalcForm;
use App\Http\Controllers\OperationEditController;
use App\Models\Category;
use App\Models\Tag;

class CalcController extends Controller{
    private $form;
    private $result;
    private $oectrl;

    public function __construct(){
        $this->form = new CalcForm();
        $this->oectrl = new OperationEditController();
    }

    public function validate($request){
        $this->form->kwota = $request->kwota;
        $this->form->years = $request->years;
        $this->form->proc = $request->proc;
        $this->form->phone = $request->phone;
        $this->form->category_id = $request->category_id;
        $this->form->tags = $request->tags;

        $valid = $request->validate([
            'kwota' => 'required|numeric',
            'years' => 'required|numeric',
            'proc' => 'required|numeric',
            'phone' => 'required|string|regex:/^\+48[0-9]{9}$/'
        ]);
        return $valid;
    }


    public function calcCompute(Request $request){
        if($this->validate($request)){
            $this->form->kwota = intval($this->form->kwota);
            $this->form->proc = floatval($this->form->proc);
            $this->form->years = floatval($this->form->years);
            $this->result = ($this->form->kwota + ($this->form->kwota * $this->form->proc/100)) / ($this->form->years*12);

            $this->sendToOEController();
            $this->oectrl->operationSave();
        }
        return $this->genView();
    }


    public function genView(){
        $categories = Category::all();
        $tags = Tag::all();
        return view('calc.index', ['form' => $this->form, 'result' => $this->result, 'categories' => $categories, 'tags' => $tags]);
    }


    public function sendToOEController(){
        $this->oectrl->result->kwota = $this->form->kwota;
        $this->oectrl->result->years = $this->form->years;
        $this->oectrl->result->procent = $this->form->proc;
        $this->oectrl->result->phone = $this->form->phone;
        $this->oectrl->result->wynik = $this->result;
        $this->oectrl->cat_id = $this->form->category_id;
        $this->oectrl->tag_id = $this->form->tags;
    }
}