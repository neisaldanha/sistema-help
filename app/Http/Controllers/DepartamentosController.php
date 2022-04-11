<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tab_usuarios;
use App\Models\Tab_pessoas;
use App\Models\Tab_chamados;
use App\Models\Tab_departamentos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Session;
use Validator;

class DepartamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dptos = DB::table('tab_departamentos')->get();
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        
        if($nivel != 'A' ){
        	//abort(403,"Acesso não autorizado");
        	Session::flash('error2', true);
        	return back()->with([
        			//'success','Usuário cadastrado com sucesso',
        			'data'=> Arr::pluck($data,'USU_LOGIN'),
        			'iduser'=>Arr::pluck($data,'ID_USUARIO'),
        			'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
        			'imagem' =>Arr::pluck($data,'FOTO'),
        			'nivel'=>$nivel,
        			
        	]);
        	
        }else{
	        //dd($users);
	        return view('painel/lista-departamentos')->with([
	            'dptos' => $dptos,
	            'data'=>Arr::pluck($data,'USU_LOGIN'),
	            'iduser'=> Arr::pluck($data,'ID_USUARIO'),
	            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	            'imagem' =>Arr::pluck($data,'FOTO'),
	            'nivel'=>$nivel,
	        ]);
        }
        //'data'=>Arr::pluck($data,'nome') 
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
        $input = $request->all();
        
        $id = $request->pessoa;
        $rules = [
            'descricao'=>'required',
        ];

        $nomes = [
            'descricao'=>'Descrição',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails()) {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

         //Insert data into database
         $dpto = new Tab_departamentos;
        
         $dpto->DESCRICAO = $request->descricao;
         $dpto->DATA_CAD = date('Y-m-d H:i:s');
      
         $save = $dpto->save();
         
         $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
         $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
         if($save){
            Session::flash('success', true);
            return back()->with([
                'success','Usuário cadastrado com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=>$nivel,

                ]);
         }else{
            Session::flash('error', true);
             return back()->with('fail','Opss..., Algo deu errado');
         }   
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

       
        $input = $request->all();
        
        $rules = [
            'descricao'=>'required',
        ];

        $nomes = [
            'descricao'=>'Descrição',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails()) {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

         //Insert data into database
         $dpto =  Tab_departamentos::findOrFail($id);;
        
         $dpto->DESCRICAO = $request->descricao;
         $dpto->DATA_UPDATE = date('Y-m-d H:i:s');
      
         $save = $dpto->update();
         
         $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
         $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
         if($save){
            Session::flash('success', true);
            return back()->with([
                'success','Usuário cadastrado com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=>$nivel,

                ]);
         }else{
            Session::flash('error', true);
             return back()->with('fail','Opss..., Algo deu errado');
         } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$dptos = DB::table('tab_departamentos')->get();
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
    	$nivel =  Arr::pluck($data,'USU_NIVEL')[0];
    	
    	if($nivel != 'A' ){
    		abort(403,"Acesso não autorizado");
    		
    	}else{
	        $dpto =  Tab_departamentos::findOrFail($id);;
	        $deleta = $dpto->delete();
	        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	        if($deleta){
	            Session::flash('success', true);
	            return back()->with([
	                'data'=> Arr::pluck($data,'USU_LOGIN')]);
	         }else{
	            Session::flash('error', true);
	             return back()->with('fail','Opss..., Algo deu errado');
	         }
    	}
         
    }
    
}
