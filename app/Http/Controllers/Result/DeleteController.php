<?php

namespace App\Http\Controllers\Result;
use App\Models\Result;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __invoke(Result $result){
        try{
            if($result->deleted_at == null){
                $result->delete();
            }
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('result.index');
    }
}
