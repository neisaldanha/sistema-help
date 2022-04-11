<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site_institucional;
use App\Models\Usuario;
use App\Models\Site_institucional_fotos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PainelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Inner join com duas tabelas. O "->On()" funcionna como um "and" no SQL.
        //Ver sql na tela basta chamar no final da instrução a função "->toSql()".

        $users = ['LoggedUserInfo'=>Usuario::where('id','=', session('LoggedUser'))->first()];
        $listas =  DB::table('site_institucionals as i')->distinct()
        ->join('site_institucional_fotos as f', function ($join) {
        $join->on('i.id', '=', 'f.id')->On('f.user','=','f.user');
        })->select('i.link','f.imagem','i.titulo','i.data_cadastro')
        ->get();
       
        return view('/painel/lista')->with([
            
            'listas' => (Object)($listas),
            'data'=>Arr::pluck($users, 'nome'),
           
            ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
