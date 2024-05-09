<?php

namespace App\Http\Controllers\Result;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;

class SaveController extends Controller
{
    public function __invoke(REQUEST $request){
        $valid = $request->validate([
            'kwota' => 'required|numeric',
            'years' => 'required|numeric',
            'proc' => 'required|numeric',
            'phone' => 'required|string|regex:/^\+48[0-9]{9}$/'
        ]);
        $kwota = $request->input('kwota');
        $years = $request->input('years');
        $procent = $request->input('proc');
        $phone = $request->input('phone');
        $category_id = $request->input('category_id');
        $tags_id = $request->input('tags');



        if($valid){
            $kwota = intval($kwota);
            $procent = floatval($procent);
            $years = floatval($years);
            $wynik = ($kwota + ($kwota * $procent/100)) / ($years*12);

            try {
                $data = [
                    'kwota' => $kwota,
                    'years' => $years,
                    'procent' => $procent,
                    'wynik' => $wynik,
                    'phone' => $phone,
                    'category_id' => $category_id
                ];
                $result = Result::create($data);
                $result->tags()->attach($tags_id);
                $categories = Category::all();
                $tags = Tag::all();
                return view('calc.index', ['kwota' => $kwota, 'years' => $years, 'procent' => $procent, 'wynik' => $wynik, 'categories' => $categories, 'tags' => $tags]);
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
    }
}
