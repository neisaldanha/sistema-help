<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tab_imagens extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_IMAGEM';
    public $fillable = ['ID_IMAGEM','IMAGEM','ID_USUARIO_FK','NM_CHAMADO','DATA_CAD'];
        
    use HasFactory;
}
