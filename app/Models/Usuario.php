<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps = FALSE;
    public $fillable = ['ID_USUARIO','ID_PESSOA','USU_NIVEL','USU_EMAIL','USU_LOGIN','USU_SENHA',
                        'USU_STATUS','USU_DATA_CAD','USU_DATA_UPDATE'];
    use HasFactory;
}
