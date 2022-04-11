<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamentos;
use App\Models\Funcoes;

class AjaxController extends Controller
{
    public static function getFuncao(Request $request)
    {
       // dd($request->p);
       return Funcoes::select('DESCRICAO')->where('ID_DPTO', $request->p)->distinct()->pluck('DESCRICAO');
    }
}
