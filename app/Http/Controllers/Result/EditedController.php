<?php

namespace App\Http\Controllers\Result;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditedController extends Controller
{
    public function __invoke(REQUEST $request){
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
}
