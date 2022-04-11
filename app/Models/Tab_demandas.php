<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tab_demandas extends Model
{
	public $timestamps = FALSE;
	public $primaryKey = 'id_demanda';
	public $fillable = ['id_demanda','d_descricao','d_status','d_data_cad'];
	
    use HasFactory;
}
