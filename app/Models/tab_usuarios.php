<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tab_usuarios extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_USUARIO';
    public $fillable = ['ID_USUARIO','ID_PESSOA','USU_NIVEL','EMAIL','USU_LOGIN','USU_SENHA',
                        'USU_STATUS','USU_DATA_CAD','USU_DATA_UPDATE'];
    use HasFactory;
}
