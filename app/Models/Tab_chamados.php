<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab_chamados extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_CHAMADO';
    public $fillable = ['ID_CHAMADO','NM_CHAMADO','ID_USUARIO','ID_INTERACAO_CHAMADO','ID_ATENDENTE','DESCRICAO',
                        'TITULO','DATA_ABERTURA','DATA_ENCERRAMENTO','STATUS'];
    
    use HasFactory;
    //public function getTextHtmlAttribute(){ return nl2br(e($this->DESCRICAO),false);}
    

    
    
}
