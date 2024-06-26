<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model{
    use HasFactory;
    use SoftDeletes;
    use Filterable;
    protected $table = 'results';
    protected $fillable = ['kwota', 'years', 'procent', 'wynik', 'phone', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'result_tags', 'result_id', 'tag_id');
    }
}
