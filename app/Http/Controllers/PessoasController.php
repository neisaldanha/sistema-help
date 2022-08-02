<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tab_pessoas;
use App\Models\Tab_departamentos;
use App\Models\Funcoes;
use App\Models\tab_usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Session;
use Validator;

class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $id = Arr::pluck($data, 'ID_PESSOA')[0];
        $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
        $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
        $users = DB::table('tab_pessoas')->where('PESSOA_STATUS','A')->get();
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        //dd(Arr::pluck($data,'USU_NIVEL'));
        
        if($nivel != 'A' ){
        	//abort(403,"Acesso não autorizado");
        	Session::flash('error2', true);
        	return back()->with([
        			//'success','Usuário cadastrado com sucesso',
        			'data'=> Arr::pluck($data,'USU_LOGIN'),
        			'iduser'=>Arr::pluck($data,'ID_USUARIO'),
        			'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
        			'imagem' => $foto,
        			'nivel'=>$nivel,
        			
        	]);
        	
        	
        }else{
	        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	        return view('painel/lista-pessoas')->with([
	            'users' => $users,
	            'iduser'=> Arr::pluck($data,'ID_USUARIO'),
	            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	            'data'=>Arr::pluck($data,'USU_LOGIN'),
	            'imagem' => $foto,
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->id == 0){
            //Validate requests
        $input = $request->all();
        //$email = $request->email;
        $rules = [
            'name'=>'required',
            'email'=>'required|EMAIL|unique:tab_pessoas',
            'end'=>'required',
            'bairro'=>'required',
            'cep'=>'required',
            'arquivo'=>'required',
        ];

        $nomes = [
            'name'=>'Nome',
            'email'=>'email',
            'end'=>'Endereço',
            'bairro'=>'Bairro',
            'cep'=>'CEP',
            'arquivo'=>'Imagem',
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
        $pessoas = new Tab_pessoas;
        //dd($request->all());
        $pessoas->PESSOA_NOME = $request->name;
        $pessoas->EMAIL = $request->email;
        $pessoas->PESSOA_CPF = $request->cpf;
        $pessoas->PESSOA_CEP = $request->cep;
        $pessoas->PESSOA_END = $request->end;
        $pessoas->PESSOA_BAIRRO = $request->bairro;
        $pessoas->PESSOA_TEL = $request->tel;
        $pessoas->ID_DPTO = $request->dpto;
        $pessoas->ID_FUNCAO = $request->funcao;
        $pessoas->PESSOA_STATUS = "A";
        $pessoas->USUARIO = 'N';
        $pessoas->DATA_CAD = date('Y-m-d H:i:s');
        $pessoas->DATA_UPDATE = date('Y-m-d H:i:s');
        $dataArq = date('Y-m-d H:i:s');
         
        
         // Define o valor default para a variável que contém o nome da imagem 
         $nameFile = null;
        
         // Verifica se informou o arquivo e se é válido
         if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
             
             // Define um aleatório para o arquivo baseado no timestamps atual
             $name = time();
             
             // Recupera a extensão do arquivo
             $extension = $request->arquivo->extension();
     
             // Define finalmente o nome
             $nameFile = "{$name}.{$extension}";
     
             // Faz o upload:
             $destino = public_path('storage');
             //dd($destino);
             $upload = $request->arquivo->move($destino,$nameFile);
         
             $pessoas->PESSOA_FOTO = $nameFile;
            
             // Verifica se NÃO deu certo o upload (Redireciona de volta)
             if ( !$upload )
                 return redirect()
                             ->back()
                             ->with('error', 'Falha ao fazer upload')
                             ->withInput();
     
         }
       
         
         $save = $pessoas->save();
         
         $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
            $id = Arr::pluck($data, 'ID_PESSOA')[0];
            $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
            $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
         $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
         if($save){
            Session::flash('success', true);
            return back()->with([
                'success','Usuário cadastrado com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' => $foto,
                'nivel'=> $nivel,
                ]);
         }else{
            Session::flash('error', true);
             return back()->with('fail','Opss..., Algo deu errado');
         }   
        }else{

           
               //Validate requests
            $input = $request->all();
           //dd($input);
            $emailnovo = $input['email'];
            $id = $input['id'];
            
            $pessoa = Tab_pessoas::findOrFail($id);
            $email = $pessoa->EMAIL;
            //dd($email,$emailnovo);
            if($email == $emailnovo){
                $rules = [
                    'name'=>'required',
                    'email'=>'required|email',
                    'end'=>'required',
                    'bairro'=>'required',
                    'cep'=>'required',
                    //'arquivo'=>'required',
                ];
            }else {
                $rules = [
                    'name'=>'required',
                    'email'=>'required|EMAIL|unique:tab_pessoas',
                    'end'=>'required',
                    'bairro'=>'required',
                    'cep'=>'required',
                    //'arquivo'=>'required',
                ];
            }
            
            $nomes = [
                'name'=>'Nome',
                'email'=>'email',
                //'password'=>'Senha',
                'tipo'=>'Tipo Acesso',
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
            $pessoas =  Tab_pessoas::findOrFail($id);
                        
            $pessoas->PESSOA_NOME = $request->name;
            $pessoas->EMAIL = $request->email;
            $pessoas->PESSOA_CPF = $request->cpf;
            $pessoas->PESSOA_CEP = $request->cep;
            $pessoas->PESSOA_END = $request->end;
            $pessoas->PESSOA_BAIRRO = $request->bairro;
            $pessoas->PESSOA_TEL = $request->tel;
            $pessoas->ID_DPTO = $request->dpto;
            $pessoas->ID_FUNCAO = $request->funcao;
            $pessoas->DATA_UPDATE = date('Y-m-d H:i:s');

            $dataArq = date('Y-m-d H:i:s');
            
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
        
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
                
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = time();
                
                // Recupera a extensão do arquivo
                $extension = $request->arquivo->extension();
        
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
        
                // Faz o upload:
                $destino = public_path('storage');
                //dd($destino);
                $upload = $request->arquivo->move($destino,$nameFile);
                $imagem = $request->arquivo;
                if($imagem){
                    $pessoas->PESSOA_FOTO = $nameFile;
                }else{
                    $pessoas->PESSOA_FOTO = $pessoas->PESSOA_FOTO;
                }
               
                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if ( !$upload )
                    return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();
        
            }
            //$user->senha = Hash::make($request->password);
            
            $update = $pessoas->update();
            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
            $id = Arr::pluck($data, 'ID_PESSOA')[0];
            $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
            $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
            if($update){
                Session::flash('success', true);
                return back()->with([
                    'success','Usuário Atualizado com sucesso',
                    'data'=> Arr::pluck($data,'USU_LOGIN'),
                    'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                    'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                    'imagem' => $foto,
                    'nivel'=>$nivel,
                ]);
            }else{
                Session::flash('error', true);
                return back()->with('fail','Opss..., Algo deu errado');
            }   
        
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
    	
    
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $id = Arr::pluck($data, 'ID_PESSOA')[0];
        $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
        $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
    	$nivel =  Arr::pluck($data,'USU_NIVEL')[0];
    
    	if($nivel != 'A' ){
    		//abort(403,"Acesso não autorizado");
    		Session::flash('error2', true);
    		return back()->with([
    				//'success','Usuário cadastrado com sucesso',
    				'data'=> Arr::pluck($data,'USU_LOGIN'),
    				'iduser'=>Arr::pluck($data,'ID_USUARIO'),
    				'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
    				'imagem' => $foto,
    				'nivel'=>$nivel,
    				
    		]);
    		
    	}else{
       
	        if($id==0){
	           
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
                $id = Arr::pluck($data, 'ID_PESSOA')[0];
                $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
                $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
	            $dpto = DB::table('tab_departamentos')->select('ID_DPTO','DESCRICAO')->get();
	            $funcoes = DB::table('tab_funcoes')->select('ID_FUNCAO','DESCRICAO')->get();
	            
	            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	            
	            return view('painel.edita-pessoa')->with([ 
	                'iduser'=>Arr::pluck($data,'ID_PESSOA'),
	                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	                 'data'=>Arr::pluck($data,'USU_LOGIN'),
	                 'imagem' => $foto,
	                 'dptos'=> $dpto,
	                 'funcoes'=> $funcoes,
	                 'nivel'=>$nivel,
	                 ]);
	        }else{
                $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
                $id = Arr::pluck($data, 'ID_PESSOA')[0];
                $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
                $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
	            $pessoas = DB::table('tab_pessoas')->get();
	
	            $qtdMneusChamados = DB::table('tab_chamados')->where('ID_USUARIO',$id)->count();
	            $qtdMeusSemAtendimmento = DB::table('tab_chamados')->where('STATUS','A')->where('ID_USUARIO',$id)->count();
	            $qtdMeusEncerrados = DB::table('tab_chamados')->where('STATUS','F')->where('ID_USUARIO',$id)->count();
	            $qtdMeuEmAtendimento = DB::table('tab_chamados')->where('STATUS','E')->where('ID_USUARIO',$id)->count();
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	           
	            $pessoa = DB::table('tab_pessoas as P')
	            ->join('tab_departamentos as D', 'D.ID_DPTO','P.ID_DPTO' )
	            ->leftjoin('tab_funcoes as F', function ($join) {
	                $join->on('P.ID_FUNCAO','F.ID_FUNCAO')->on('F.ID_DPTO','D.ID_DPTO');
	            })
	            ->where('P.ID_PESSOA',$id)
	            ->select('P.PESSOA_NOME','P.ID_PESSOA', 'P.PESSOA_CPF','P.EMAIL','P.PESSOA_CEP','P.PESSOA_BAIRRO','P.PESSOA_TEL', 'P.ID_DPTO','P.ID_FUNCAO','F.ID_FUNCAO', 'F.DESCRICAO AS FUNCAO','P.PESSOA_FOTO', 'D.*')
	            ->get();
	            $dpto = DB::table('tab_departamentos')->select('ID_DPTO','DESCRICAO')->get();
	            $funcoes = DB::table('tab_funcoes')->select('ID_FUNCAO','DESCRICAO')->get();
	            //dd($pessoa[0]);
	            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	            
	            //dd( $pessoa);
	            return view('painel.edita-pessoa')->with([
	                'pessoa' => $pessoa[0],
	                'data'=>Arr::pluck($data,'USU_LOGIN'),
	                'iduser'=> Arr::pluck($data,'ID_PESSOA'),
	                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	                'imagem' =>$foto,
	                'pessoas'=>$pessoas,
	                'dptos'=> $dpto,
	                'funcoes'=> $funcoes,
	                'nivel'=>$nivel,
	                'qtdchamados'=>$qtdMneusChamados,
	                'qtdSemAtendimento'=>$qtdMeusSemAtendimmento, 
	                'qtdFechados'=>$qtdMeusEncerrados,
	                'qtdEmAtendimento'=>$qtdMeuEmAtendimento,
	                ]);
	        }
    	}
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {

    	
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        
        $id = Arr::pluck($data, 'ID_PESSOA')[0];
        $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
        $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
    	$nivel =  Arr::pluck($data,'USU_NIVEL')[0];
    	
    	if($nivel != 'A' ){
    		//abort(403,"Acesso não autorizado");
    		Session::flash('error2', true);
    		return back()->with([
    				//'success','Usuário cadastrado com sucesso',
    				'data'=> Arr::pluck($data,'USU_LOGIN'),
    				'iduser'=>Arr::pluck($data,'ID_USUARIO'),
    				'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
    				'imagem' =>$foto,
    				'nivel'=>$nivel,
    				
    		]);
    		
    	}else{
	        if($id){
	            
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
                $id = Arr::pluck($data, 'ID_PESSOA')[0];
                $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
                $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
	            $pessoa = Tab_pessoas::findOrFail($id);
	            
	            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	            return view('painel.edita-pessoa')->with([
	                'pessoas' => (Object)($pessoa),
	                'data'=>Arr::pluck($data,'USU_LOGIN'),
	                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
	                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	                'imagem' =>$foto,
	                'nivel'=>$nivel,
	
	            ]);    
	        }else{
	                        
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
                 $id = Arr::pluck($data, 'ID_PESSOA')[0];
                $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
                $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
	            $pessoa = Tab_pessoas::findOrFail($id);
	            return view('painel.edita-pessoa')->with([
	                'pessoas' => (Object)($pessoa),
	                'data'=>Arr::pluck($data,'USU_LOGIN'),
	                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
	                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	                'imagem' =>$foto,
	                'nivel'=>$nivel,
	            ]);
	            
	        } 
    	}

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
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $id = Arr::pluck($data, 'ID_PESSOA')[0];
        $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
        $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
    	$users = DB::table('tab_pessoas')->where('PESSOA_STATUS','A')->get();
    	$nivel =  Arr::pluck($data,'USU_NIVEL')[0];
    	//dd(Arr::pluck($data,'USU_NIVEL'));
    	
    	if($nivel != 'A' ){
    		//abort(403,"Acesso não autorizado");
    		Session::flash('error2', true);
    		return back()->with([
    				//'success','Usuário cadastrado com sucesso',
    				'data'=> Arr::pluck($data,'USU_LOGIN'),
    				'iduser'=>Arr::pluck($data,'ID_USUARIO'),
    				'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
    				'imagem' =>$foto,
    				'nivel'=>$nivel,
    				
    		]);
    		
    		
    	}else{
	        $pessoa= Tab_pessoas::findOrFail($id);
	        //exclui imagem da pasta 
	       /* $imagem = $user->avatar;
	        Storage::disk('public')->delete($imagem);
	        */
	        $pessoa->PESSOA_STATUS = 'I' ;
	        $pessoa->DATA_UPDATE = date('Y-m-d H:i:s');
	        $inativado = $pessoa->update();
	        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	        
	        if($inativado){
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
