<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab_departamentos extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_DPTO';
    public $fillable = ['ID_DPTO','DESCRICAO','DATA_CAD','DATA_UPDATE'];
    use HasFactory;
}
