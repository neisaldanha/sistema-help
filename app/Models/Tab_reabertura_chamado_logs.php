<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab_reabertura_chamado_logs extends Model
{
    public $timestamps = FALSE;
    public $primaryKey = 'ID_REABERTURA';
    public $fillable  = ['ID_REABERTURA', 'NM_CHAMADO', 'ID_USUARIO', 'DATA_REABERTURA'];
    use HasFactory;
}
