<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function results(){
        return $this->belongsToMany(Result::class, 'result_tags', 'tag_id', 'result_id');
    }
}
