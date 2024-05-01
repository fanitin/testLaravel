<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model{
    use HasFactory;
    protected $table = 'results';
    public $timestamps = false;
    protected $fillable = ['kwota', 'years', 'procent', 'wynik', 'data', 'phone'];
    public $id;
    public $kwota;
    public $years;
    public $procent;
    public $wynik;
    public $data;
    public $phone;
}
