<?php
namespace App\Services\Result;

use App\Models\Result;

class Service{
    public function save($data){
        $data['wynik'] = ($data['kwota'] + ($data['kwota'] * $data['procent']/100)) / ($data['years']*12);
        $tags_id = $data['tags'];
        $result = Result::create($data);
        $result->tags()->attach($tags_id);
        return $data;
    }

    public function edited($data, $result){
        $tags = $data['tags'];
        $data['wynik'] = ($data['kwota'] + ($data['kwota'] * $data['procent']/100)) / ($data['years']*12);
        $operation = Result::find($result->id);
        $operation->update($data);
        $operation->tags()->sync($tags);
    }
}