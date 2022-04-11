<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab_interacao_chamados extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_INTERACAO_CHAMADO';
    public $fillable = ['ID_INTERACAO_CHAMADO','INT_DESC_CHAMADO','ID_CHAMADO','INT_DATA_CAD','ID_USUARIO'];
    
    use HasFactory;
}
