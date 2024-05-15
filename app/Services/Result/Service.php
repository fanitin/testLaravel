<?php
namespace App\Services\Result;

use App\Models\Result;

class Service{
    public function save($data){
        $wynik = ($data['kwota'] + ($data['kwota'] * $data['procent']/100)) / ($data['years']*12);
        $data['wynik'] = ceil($wynik * 100) / 100;
        $tags_id = $data['tags'];
        $result = Result::create($data);
        $result->tags()->attach($tags_id);
        return $result;
    }

    public function edited($data, $result){
        $tags = $data['tags'];
        $wynik = ($data['kwota'] + ($data['kwota'] * $data['procent']/100)) / ($data['years']*12);
        $data['wynik'] = ceil($wynik * 100) / 100;
        $operation = Result::find($result->id);
        $operation->update($data);
        $operation->tags()->sync($tags);
        /*foreach ($this->tag_id as $tag) {
                    ResultTag::firstOrCreate([
                        'result_id' => $result->id,
                         'tag_id' => $tag
                    ]);
                } to inny sposob, raczej go bede uzywal przy pisaniu projektu zaliczeniowego, bo też można dodac ilosc produktów np*/
    }
}