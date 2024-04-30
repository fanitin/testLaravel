<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Forms\OperationEditForm;

class OperationEditController extends Controller{
    public $oeForm;

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
}