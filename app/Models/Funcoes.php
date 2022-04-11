<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcoes extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_FUNCAO';
    public $fillable = ['ID_FUNCAO','ID_DPTO','ID_PESSOA','DESCRICAO','DATA_CAD'];
    use HasFactory;
}
