<?php

namespace App\Http\Controllers\Result;
use App\Http\Requests\Result\EditedRequest;
use App\Models\Result;

class EditedController extends BaseController{
    public function __invoke(EditedRequest $request, Result $result){
        #if (!$request->filled(['kwota', 'years', 'procent', 'phone'])) {
        #    return redirect()->back()->withErrors('Proszę wypełnić wszystkie pola.');
        #}
        $data = $request->validated();

        $this->service->edited($data, $result);
        
        return redirect()->route('result.index');
    }
}
