<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tab_visu_chamados extends Model
{
	public $timestamps = FALSE;
	public $primaryKey = 'id';
	public $fillable = ['id','id_dpto','view','data_visu'];
	use HasFactory;
}
