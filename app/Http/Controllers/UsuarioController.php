<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tab_usuarios;
use App\Models\Tab_pessoas;
use App\Models\Tab_chamados;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Session;
use Validator;

class UsuarioController extends Controller
{


    function login(){
        
        return view('auth.login');
    }
    function register(){
        
        $user = tab_usuarios::findOrFail($id);
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        return view('admin.register')->with([
            'data' => Arr::pluck($data,'USU_LOGIN'),
            'user'=> (Object)($user),
            'iduser'=>Arr::pluck($data,'ID_USUARIO'),
            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
            'imagem' =>Arr::pluck($data,'PESSOA_FOTO'),
            'nivel'=>$nivel,
            ]);
    }
    function save(Request $request)
    {
        
        //
    }

    function check(Request $request){

        
        //Validate requests
        $request->validate([
             'email'=>'required',
             'password'=>'required|min:5|max:12'
        ]);

        $userInfo = tab_usuarios::where('EMAIL','=', $request->email)
        ->orWhere('CPF','=',$request->email)
        ->where('USU_STATUS','=','A')
        ->first();
        if(!$userInfo){
            return back()->with('fail','Opss...Você não está cadastrado!');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->USU_SENHA)){
                $request->session()->put('LoggedUser', $userInfo->ID_USUARIO);
                $qtdChamados = DB::table('tab_chamados')->where('STATUS','A')->count();
                $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
                $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
                //dd( $qtdChamados);
                return redirect('/admin/home')->with([
                    'qtd'=> $qtdChamados,
                    'nivel'=>$nivel,
                ]);

            }else{
                return back()->with('fail','Senha incorreta');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }

    function dashboard(){

        $ano = date('Y') ;
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $id = Arr::pluck($data,'ID_PESSOA')[0];
        $dpto = Arr::pluck($data,'ID_DPTO')[0];
                
        $chamados = DB::table('tab_chamados')->get();
       
        $users = Tab_pessoas::get();
        $qtdChamados = DB::table('tab_chamados')->count();
        $qtdMneusChamados = DB::table('tab_chamados')->where('ID_USUARIO',$id)->count();
        // Qtd Abertos no Mes
        $aJan = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
        $aFev = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
        $aMar = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
        $aAbr = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
        $aMai = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
        $aJun = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
        $aJul = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
        $aAgo = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
        $aSet = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
        $aOut = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
        $aNov = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
        $aDez = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
        $abertos = [$aJan,$aFev,$aMar,$aAbr,$aMai,$aJun,$aJul,$aAgo,$aSet,$aOut,$aNov,$aDez];
        // Qtd Fechados no Mes
        $fJan = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
        $fFev = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
        $fMar = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
        $fAbr = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
        $fMai = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
        $fJun = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
        $fJul = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
        $fAgo = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
        $fSet = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
        $fOut = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
        $fNov = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
        $fDez = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
        $fechados = [$fJan,$fFev,$fMar,$fAbr,$fMai,$fJun,$fJul,$fAgo,$fSet,$fOut,$fNov,$fDez];
        // Qtd EM Atendimento no Mes
        $eJan = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
        $eFev = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
        $eMar = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
        $eAbr = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
        $eMai = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
        $eJun = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
        $eJul = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
        $eAgo = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
        $eSet = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
        $eOut = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
        $eNov = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
        $eDez = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
        $emAtendimento = [$eJan,$eFev,$eMar,$eAbr,$eMai,$eJun,$eJul,$eAgo,$eSet,$eOut,$eNov,$eDez];
                        
        $qtdSemAtendimmento = DB::table('tab_chamados')->where('STATUS','A')->count();
        $qtdMeusSemAtendimmento = DB::table('tab_chamados')->where('STATUS','A')->where('ID_USUARIO',$id)->count();

        $qtdEncerrados = DB::table('tab_chamados')->where('STATUS','F')->count();
        $qtdMeusEncerrados = DB::table('tab_chamados')->where('STATUS','F')->where('ID_USUARIO',$id)->count();
        
        $qtdEmAtendimento = DB::table('tab_chamados')->where('STATUS','E')->count();
        $qtdMeuEmAtendimento = DB::table('tab_chamados')->where('STATUS','E')->where('ID_USUARIO',$id)->count();

        $qtdUsuarios = DB::table('tab_usuarios')->where('USU_STATUS','A')->count();
        $percente = ($qtdEncerrados * 100)/$qtdChamados ;
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        if($nivel == "A"){
            $qtd = $qtdChamados;
            $encerrados = $qtdEncerrados;
            $atendidos =  $qtdEmAtendimento;
            $semAtendimento = $qtdSemAtendimmento;
        }else{
            $qtd = $qtdMneusChamados;
            $encerrados = $qtdMeusEncerrados;
            $atendidos = $qtdMeuEmAtendimento;
            $semAtendimento = $qtdMeusSemAtendimmento;
            
        }
        
        $status = Arr::pluck($chamados,'STATUS');
        //dd($status);
        //dd(Arr::pluck($data,'ID_PESSOA'));
        return view('admin.home')->with([
            'data'=>Arr::pluck($data,'USU_LOGIN'),
            'iduser'=> Arr::pluck($data,'ID_USUARIO'),
            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
            'imagem' =>Arr::pluck($data,'FOTO'),
            'qtdChamados'=>$qtd,
            'qtdUsuarios'=>$qtdUsuarios,
            'qtdSemAtendimmento'=>$semAtendimento,
            'qtdEncerrados'=>$encerrados,
            'percente'=> number_format($percente, 2, ',', ''),
            'nivel'=>$nivel,
            'qtdEmAtendimento'=>$atendidos,
            // usa nos Graficos
            'chamados'=>$chamados,
            'abertos'=>$abertos,
            'fechados'=>$fechados,
            'emAtendimento'=>$emAtendimento,
            
        ]);
    }

    function settings(){
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        return view('admin.settings', $data);
    }

    function profile(){
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        return view('admin.profile', $data);
    }
    function staff(){
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        return view('admin.staff', $data);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = DB::table('tab_usuarios as U')
        ->join('tab_pessoas as P','P.ID_PESSOA','U.ID_PESSOA')
        ->where('U.USU_STATUS','A')
        ->select('P.PESSOA_NOME','P.ID_PESSOA', 'P.PESSOA_CPF', 'P.ID_DPTO','P.ID_FUNCAO','U.ID_USUARIO', 'U.USU_LOGIN', 'U.USU_NIVEL','P.PESSOA_FOTO','U.EMAIL')
        ->get();
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
	        return view('admin/usuarios')->with([
	            'users' => $users,
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
        
	        if($request->id == 0){
	           
	        $input = $request->all();
	        
	        $id = $request->pessoa;
	        $rules = [
	            'usuario'=>'required',
	            //'email'=>'required|EMAIL|unique:tab_usuarios',
	            'password'=>'required|min:5|max:12',
	            'tipo'=>'required',
	            //'arquivo'=>'required',
	        ];
	
	        $nomes = [
	            'usuario'=>'Login',
	            //'email'=>'email',
	            'password'=>'Senha',
	            'tipo'=>'Tipo Acesso',
	            //'arquivo'=>'Imagem',
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
	         $user = new tab_usuarios;
	         
	         $pessoa = DB::table('tab_pessoas')->where('ID_PESSOA',$id)->select('EMAIL','PESSOA_FOTO','ID_DPTO','PESSOA_CPF')->get();
	         $pessoausuario = Tab_pessoas::findOrFail($id);
	         $email = Arr::pluck($pessoa,'EMAIL');
	         $dpto = Arr::pluck($pessoa,'ID_DPTO');
	         $foto = Arr::pluck($pessoa,'PESSOA_FOTO');
	         $cpf = Arr::pluck($pessoa,'PESSOA_CPF');
	        
	         $user->EMAIL = $email[0];
	         $user->CPF = $cpf[0];
	         $user->FOTO = $foto[0];
	         $user->ID_DPTO = $dpto[0];
	         $user->USU_NIVEL = $request->tipo;
	         $user->USU_LOGIN = $request->usuario;
	         $user->ID_PESSOA = $request->pessoa;
	         $user->SENHA = $request->password;
	         $user->USU_STATUS = "A";
	         $user->USU_DATA_CAD = date('Y-m-d H:i:s');
	         $user->USU_DATA_UPDATE = date('Y-m-d H:i:s');
	         //$dataArq = date('Y-m-d H:i:s');
	        
	         $pessoausuario->USUARIO = 'S';
	         $user->USU_SENHA = Hash::make($request->password);
	         $save = $user->save();
	         $save2 = $pessoausuario->update();
	         
	         $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	         $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	         if($save && $save2){
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
	        }else{
	
	           
	               //Validate requests
	            $input = $request->all();
	           //dd($email,$emailnovo);
	            
	            $rules = [
	                'usuario'=>'required',
	                //'email'=>'required|EMAIL|unique:tab_usuarios',
	                'password'=>'required|min:5|max:12',
	                //'tipo'=>'required',
	            ];
	            
	            
	            $nomes = [
	                'usuario'=>'Nome',
	                //'email'=>'email',
	                'password'=>'Senha',
	                //'tipo'=>'Tipo Acesso',
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
	
	            $id = $request->id;
	            $user = tab_usuarios::findOrFail($id);
	            
	            
	            $user->USU_NIVEL = $request->tipo;
	            $user->USU_LOGIN = $request->usuario;
	            $user->SENHA = $request->password;
	            $user->USU_DATA_UPDATE = date('Y-m-d H:i:s');
	
	            
	
	            $user->USU_SENHA = Hash::make($request->password);
	            $save = $user->update();
	            
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	            if($save){
	                Session::flash('success', true);
	                return back()->with([
	                    'success','Usuário Atualizado com sucesso',
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
       
	        if($id==0){
	           
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	            $pessoas = DB::table('tab_pessoas')->get();
	            $users = DB::table('tab_pessoas')->where('USUARIO','N')->get();
	            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	            
	            return view('admin.register')->with([ 
	                
	                'pessoas' => json_decode($users),
	                'data'=>Arr::pluck($data,'USU_LOGIN'),
	                'iduser'=> Arr::pluck($data,'ID_USUARIO'),
	                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	                'imagem' =>Arr::pluck($data,'FOTO'),
	                'nivel'=>$nivel,
	            ]);
	        }else{
	          
	            $user = tab_usuarios::findOrFail($id);
	           
	            $pessoas = DB::table('tab_pessoas')->get();
	            $users = DB::table('tab_usuarios as U')
	            ->join('tab_pessoas as P','P.ID_PESSOA','U.ID_PESSOA')
	            ->where('U.ID_USUARIO',$id)
	            ->select('P.PESSOA_NOME','P.ID_PESSOA', 'P.PESSOA_CPF', 'P.ID_DPTO','P.ID_FUNCAO','U.ID_USUARIO', 'U.USU_LOGIN', 'U.USU_NIVEL','P.PESSOA_FOTO','U.EMAIL')
	            ->get();
	           
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	            return view('admin.register')->with([
	                'pessoas' => $pessoas->pluck('PESSOA_NOME','ID_PESSOA'),
	                'pessoa' =>$users->pluck('PESSOA_NOME')[0],
	                'user' => (Object)($user),
	                'users' => $users->pluck('PESSOA_FOTO'),
	                'data' => Arr::pluck($data,'USU_LOGIN'),
	                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
	                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	                'imagem' =>Arr::pluck($data,'FOTO'),
	                'nivel'=> $nivel,
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
	        if($id){
	            $data = tab_usuarios::findOrFail($id);
	            return view('admin.register')->with([
	                 'data' => (Object)($data),
	                 'iduser'=>Arr::pluck($data,'ID_USUARIO'),
	                 'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
	                 'nivel'=>Arr::pluck($data,'USU_NIVEL'),
	        ]);    
	        }else{
	            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
	            $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
	            return view('admin.register')->with([
	                'data'=>Arr::pluck($data,'USU_LOGIN'),
	                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
	                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
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
    public function update(Request $request)
    {
        
       //nada
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
	        $user= tab_usuarios::findOrFail($id);
	        //exclui imagem da pasta 
	       /* $imagem = $user->avatar;
	        Storage::disk('public')->delete($imagem);
	        */
	        $user->USU_STATUS = 'I' ;
	        $user->USU_DATA_UPDATE = date('Y-m-d H:i:s');
	        $inativado = $user->update();
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
