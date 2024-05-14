<?php

namespace App\Http\Controllers\Admin\Result;

use App\Http\Controllers\Controller;
use App\Http\Filters\ResultFilter;
use App\Http\Requests\Result\FilterRequest;
use App\Models\Result;

class DeleteController extends Controller{
    public function __invoke(Result $result){
        try{
            if($result->deleted_at == null){
                $result->delete();
            }
        } catch(\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('admin.result.index');
    }
}