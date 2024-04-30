<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Forms\CalcForm;
use App\Http\Forms\CalcResult;
use App\Http\Controllers\OperationEditController;

class CalcController extends Controller{
    private $form;
    private $result;
    private $oectrl;

    public function __construct(){
        $this->form = new CalcForm();
        $this->result = new CalcResult();
        $this->oectrl = new OperationEditController();
    }

    public function validate($request){
        $this->form->kwota = $request->kwota;
        $this->form->years = $request->years;
        $this->form->proc = $request->proc;
        $this->form->phone = $request->phone;

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
            $this->result->result = ($this->form->kwota + ($this->form->kwota * $this->form->proc/100)) / ($this->form->years*12);

            $this->sendToOEController();
            $this->oectrl->operationSave();
        }
        return $this->genView();
    }


    public function genView(){
        return view('calc', ['form' => $this->form, 'result' => $this->result]);
    }


    public function sendToOEController(){
        $this->oectrl->oeForm->kwota = $this->form->kwota;
        $this->oectrl->oeForm->years = $this->form->years;
        $this->oectrl->oeForm->procent = $this->form->proc;
        $this->oectrl->oeForm->phone = $this->form->phone;
        $this->oectrl->oeForm->wynik = $this->result->result;
        $this->oectrl->oeForm->data = date('Y-m-d H:i:s');
    }
}