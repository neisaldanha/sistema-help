<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab_pessoas extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_PESSOA';
    public $fillable = ['ID_PESSOA','PESSOA_NOME','PESSOA_FOTO','PESSOA_EMAIL','PESSOA_CPF',
                        'PESSOA_CEP','PESSOA_END','PESSOA_BAIRRO','PESSOA_TEL','PESSOA_STATUS',
                        'DATA_CAD','DATA_UPDATE','PESSOA_DPTO','PESSOA_FUNCAO'];
    use HasFactory;
}
