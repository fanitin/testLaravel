<?php
namespace App\Http\Forms;
use Illuminate\Database\Eloquent\Model;

class OperationEditForm extends Model{
    protected $table = 'main';
    public $timestamps = false;
    protected $skipTimestamps = true;
    protected $fillable = ['kwota', 'years', 'procent', 'wynik', 'data', 'phone'];
    protected $primaryKey = 'id_wynik';
    public $id;
    public $kwota;
    public $years;
    public $procent;
    public $wynik;
    public $data;
    public $phone;

}