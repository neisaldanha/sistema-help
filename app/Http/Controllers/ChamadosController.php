<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tab_usuarios;
use App\Models\Tab_pessoas;
use App\Models\Tab_chamados;
use App\Models\tab_imagens;
use App\Models\Tab_interacao_chamados;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Models\Tab_reabertura_chamado_logs as ModelsTab_reabertura_chamado_logs;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Tab_demandas;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Tab_departamentos;
use App\Models\tab_visu_chamados;
use App\Models\tab_reabertura_chamado_logs;

class ChamadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        
        $id =  Arr::pluck($data,'ID_PESSOA')[0];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        
        
       
        $todosChamados = DB::table('tab_chamados as C')
        ->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
        ->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
        ->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
        ->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
        ->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO',
        		'C.ID_CHAMADO','C.TITULO','DE.d_descricao','C.DESCRICAO','C.DATA_ABERTURA','ID_ATENDENTE',
        		'C.STATUS','U.USU_LOGIN','P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
        ->orderBy('C.DATA_ABERTURA','ASC')
        ->get();
        //dd($todosChamados);
        $meusChamados = DB::table('tab_chamados as C')
        ->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
        ->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
        ->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
        ->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
        ->where('C.ID_USUARIO',$id)
        ->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO',
        		'C.ID_CHAMADO','C.TITULO','DE.d_descricao','C.DESCRICAO','C.DATA_ABERTURA','ID_ATENDENTE',
        		'C.STATUS','U.USU_LOGIN','P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
        ->orderBy('C.DATA_ABERTURA','ASC')
        ->get();
       
        $inter = DB::table('tab_interacao_chamados as I')
        ->join('tab_chamados as C','C.ID_CHAMADO', 'I.ID_CHAMADO')
        ->leftJoin('tab_usuarios as U','U.ID_USUARIO','C.ID_USUARIO')
        ->join('tab_pessoas as P', 'P.ID_PESSOA','I.ID_USUARIO')
        ->select('P.ID_PESSOA','P.PESSOA_NOME','C.ID_CHAMADO','C.NM_CHAMADO',
                'C.TITULO','C.DESCRICAO','I.ID_INTERACAO_CHAMADO',
                'I.INT_DESC_CHAMADO','C.PRIORIDADE')
        ->get();  // ->paginate(15);
        
        //dd($inter);
        $imgs = DB::table('tab_chamados as C')
        ->leftJoin('tab_imagens as I','C.NM_CHAMADO','I.NM_CHAMADO')
        ->select('C.NM_CHAMADO','I.IMAGEM')
        ->get();
        

        $dptos = DB::table('tab_departamentos')->get();

        if($nivel == "A"){
            $chamado = $todosChamados;
        }else{
            $chamado = $meusChamados;
        }
        return view('painel/lista-chamados')->with([
            
                'chamados'=>$chamado,
                'imgs'=>$imgs,
                'int'=>$inter,
                'data' => Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=> $nivel, 
                'dptos'=> $dptos, 
        ]);
        
    }
    
    public function chamadosDpto() {
        
        
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $dpto = Arr::pluck($data,'ID_DPTO')[0];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $id =  Arr::pluck($data,'ID_PESSOA')[0];
        
        $chamados = DB::table('tab_chamados as C')
        ->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
        ->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
        ->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
        ->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
        ->where('C.ID_DPTO',$dpto)
        ->where('C.STATUS','<>','F')
        ->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO','C.ID_CHAMADO','ID_ATENDENTE',
        		'C.TITULO','C.DESCRICAO','DE.d_descricao','C.DATA_ABERTURA','C.STATUS','U.USU_LOGIN',
        		'P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
         ->orderBy('C.DATA_ABERTURA')
        ->get();

        $gabriel = DB::table('tab_chamados as C')
        ->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
        ->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
        ->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
        ->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
        ->whereIn('C.ID_DPTO',[1,7,8])
        ->where('C.STATUS','<>','F')
        ->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO','C.ID_CHAMADO','ID_ATENDENTE',
        		'C.TITULO','C.DESCRICAO','DE.d_descricao','C.DATA_ABERTURA','C.STATUS','U.USU_LOGIN',
        		'P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
         ->orderBy('C.DATA_ABERTURA')
        ->get();
       
        //dd($gabriel);

        if($dpto == 19){
            $chamadosDpto = $gabriel;
        }else{
            $chamadosDpto = $chamados;
        }
        
        $inter = DB::table('tab_interacao_chamados as I')
        ->join('tab_chamados as C','C.ID_CHAMADO', 'I.ID_CHAMADO')
        ->leftJoin('tab_usuarios as U','U.ID_USUARIO','C.ID_USUARIO')
        ->join('tab_pessoas as P', 'P.ID_PESSOA','I.ID_USUARIO')
        ->select('P.ID_PESSOA','P.PESSOA_NOME','C.ID_CHAMADO','C.NM_CHAMADO','C.TITULO',
                'C.DESCRICAO','I.ID_INTERACAO_CHAMADO','I.INT_DESC_CHAMADO')
        ->get();  
         
        $imgs = DB::table('tab_chamados as C')
            ->leftJoin('tab_imagens as I','C.NM_CHAMADO','I.NM_CHAMADO')
            ->select('C.NM_CHAMADO','I.IMAGEM')
            ->get();
        $dptos = DB::table('tab_departamentos')->get();
        return view('painel/lista-chamados-dpto')->with([
            'chamados'=>$chamadosDpto,
            'imgs'=>$imgs,
            'int'=>$inter,
            'data' => Arr::pluck($data,'USU_LOGIN'),
            'iduser'=>Arr::pluck($data,'ID_USUARIO'),
            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
            'imagem' =>Arr::pluck($data,'FOTO'),
            'nivel'=> $nivel, 
            'dptos'=> $dptos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $pessoas = DB::table('tab_pessoas')->get();
        $dptos = DB::table('tab_departamentos')->get();
        $demandas = DB::table('tab_demandas')->get();
        
        return view('painel.create-chamado')->with([ 
            'data'=>Arr::pluck($data,'USU_LOGIN'),
            'iduser'=>Arr::pluck($data,'ID_USUARIO'),
            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
            'imagem' =>Arr::pluck($data,'FOTO'),
            'nivel'=>$nivel,
            'dptos'=>$dptos,
        	'demandas'=>$demandas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        
               
            //Validate requests
        $input = $request->all();
       
               
        $rules = [
            'demanda'=>'required',
            'descricao'=>'required',
        ];

        $nomes = [
            'demanda'=>'Demanda',
            'descricao'=>'DescriÃ§Ã£o',
            
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
        $chamado = new Tab_chamados;
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $id = Arr::pluck($data,'ID_PESSOA')[0];
                
        $iduser = Arr::pluck($data,'ID_USUARIO')[0];
        //dd($input);
        $chamado->NM_CHAMADO = date('YmdHis');
        $chamado->ID_USUARIO =  $id;
        $chamado->ID_DPTO =  $request->dpto;
        $chamado->DESCRICAO = $request->descricao;
        $chamado->TITULO = $request->demanda;
        $chamado->DATA_ABERTURA = date('Y-m-d H:i:s');
        $chamado->STATUS = 'A';
        $chamado->VIEW = 'N';
        $chamado->PRINT = 0;
        $chamado->PRIORIDADE = 3;
        
        $id_usuario = Arr::pluck($data,'ID_USUARIO')[0];  
        $images = $request->file('arquivo');
        $destino = public_path('storage');
        
        // Verifica se foi enviada a imagem.
        if($images!= null){
           $qtd = count($images);

             // Faz Upload de arquivos e insere no banco
           foreach ($images as $item){
               if($qtd > 0){
                   $tab_imagem = new tab_imagens;
                   $imageName = $item->getClientOriginalName();
                   $item->move($destino,$imageName);
                   $arr[] = $imageName;
                   $tab_imagem->IMAGEM =  $imageName; 
                   $tab_imagem->ID_USUARIO =  strval($id_usuario); 
                   $tab_imagem->NM_CHAMADO =  date('YmdHis'); 
                   $tab_imagem->DATA_CAD =  date('Y-m-d H:i:s'); 
                    
                    $tab_imagem->save();
               }
           }
        }
      
        $save = $chamado->save();
        
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $dpto = $request->dpto;
        $pessoa = DB::table('tab_pessoas as P')
        ->join('tab_departamentos as D', 'P.ID_DPTO','D.ID_DPTO')
        ->where('P.ID_DPTO', $dpto)
        ->select('P.EMAIL')
        ->get();
        
        // Envia E-mail.
        
        $mail = [
            'nome'=>Arr::pluck($data,'USU_LOGIN')[0],
            'message'=> $request->descricao,
        ];
        $toemail = Arr::pluck($pessoa,'EMAIL');
        $copyemail = Arr::pluck($data,'EMAIL')[0];
       
        //dd($toemail,$copyemail);

            Mail::to($toemail)
            ->cc($copyemail)
            ->send(new SendMail($mail));
                  
        if($save){
            Session::flash('success', true);
            return back()->with([
                'success','UsuÃ¡rio cadastrado com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel' => $nivel,
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
    	
        $chamados = Tab_chamados::findOrFail($id);
        $dpto = $chamados->ID_DPTO;
        //dd($chamados->ID_DPTO);
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $pessoas = DB::table('tab_pessoas')->get();
                
        return view('painel/create-interacao')->with([
            
                'chamados'=>$chamados,
                'data' => Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=> $nivel, 
                'dpto'=> $dpto, 
                
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd("edit chegou");
        $chamado = Tab_chamados::findOrFail($id);
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $idusuario = Arr::pluck($data,'ID_PESSOA');
        
        $chamado->ID_ATENDENTE = (int)$idusuario[0];
        $chamado->STATUS = 'E';
        $chamado->VIEW = 'S';
        $chamado->DATA_ATENDIMENTO = date('Y-m-d H:i:s');

        $update = $chamado->update();

        if($update){
            Session::flash('success', true);
            return back()->with([
                'success','InteraÃ§Ã£o cadastrada com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel' => $nivel ,
                ]);
         }else{
            Session::flash('error', true);
             return back()->with('fail','Opss..., Algo deu errado');
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
    	
    	
            //Validate requests
        $input = $request->all();
        
        //dd($input);
        $file = $request->file('arquivo');
        //dd($file);
        
        $id = $input['id'];
        //dd($request->dpto);
        $rules = [
            'interacao'=>'required',
        ];

        $nomes = [
            'interacao'=>'Interacao',
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
        $inter = new tab_interacao_chamados;
        $idchamado = Tab_chamados::findOrFail($id);
        
        
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $idusuario = Arr::pluck($data,'ID_PESSOA');
        $images = $request->file('arquivo'); //$request->file('arquivo');
        //dd($input['arquivo']);
        $id_usuario = Arr::pluck($data,'ID_USUARIO')[0];  
        //$images = $input['arquivo'];
        $destino = public_path('storage');
        
        //dd($images,$input);
        
        $inter->INT_DESC_CHAMADO = $request->interacao;
        $inter->ID_CHAMADO = $request->id;
        $inter->INT_DATA_CAD = date('Y-m-d H:i:s');
        $inter->ID_USUARIO = $idusuario[0];
        
        
        // Verifica se foi enviada a imagem.
        if($images!= null){
           $qtd = count($images);

             // Faz Upload de arquivos e insere no banco
           foreach ($images as $item){
               if($qtd > 0){
                   $tab_imagem = new tab_imagens;
                   $imageName = $item->getClientOriginalName();
                   $item->move($destino,$imageName);
                   $arr[] = $imageName;
                   $tab_imagem->IMAGEM =  $imageName; 
                   $tab_imagem->ID_USUARIO =  strval($id_usuario); 
                   $tab_imagem->NM_CHAMADO =  $idchamado->NM_CHAMADO; 
                   $tab_imagem->DATA_CAD =  date('Y-m-d H:i:s'); 
                    
                    $tab_imagem->save();
               }
           }
        }
        

        $save = $inter->save();
        //$save2 = $idchamado->update();
        
        $dpto = $request->dpto;
        $chamado = Tab_chamados::findOrFail($id);

        // $pessoa pega o email do departamento
        $pessoa = DB::table('tab_pessoas as P')
        ->join('tab_departamentos as D', 'P.ID_DPTO','D.ID_DPTO')
        ->where('P.ID_DPTO', $dpto)
        ->select('P.EMAIL')
        ->get();

        $userid = $chamado->ID_USUARIO;
        $idch = $chamado->ID_CHAMADO;
        // $emailpessoa pega email do solicitante do chamado
        $emailpessoa = DB::table('tab_usuarios as U')
        ->join('tab_chamados as C', 'C.ID_USUARIO','U.ID_PESSOA' )
        ->where('C.ID_USUARIO', $userid)
        ->where('C.ID_CHAMADO', $idch)
        ->select('U.EMAIL')
        ->get();

        //dd($copyemail);
        
        //Envia E-mail.
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $mail = [
            'nome'=>Arr::pluck($data,'USU_LOGIN')[0],
            'message'=> $request->interacao,
        ];

        //pegando somente o email
        $mailsolicitante = Arr::pluck($emailpessoa,'EMAIL')[0];
        $toemail = Arr::pluck($pessoa,'EMAIL');
        $copyemail = Arr::pluck($data,'EMAIL')[0];
       
       
            Mail::to($toemail)
            ->cc([$copyemail, $mailsolicitante])
            ->send(new SendMail($mail));
            
         if($save){
            Session::flash('success', true);
            return back()->with([
                //'success','InteraÃ§Ã£o cadastrada com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel' => $nivel ,
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
        $reabre = new Tab_reabertura_chamado_logs;
        $chamado= Tab_chamados::findOrFail($id);
              
        $status = $chamado->STATUS;
        $nmChamado = $chamado->NM_CHAMADO;
        $idUsuario = $chamado->ID_USUARIO;
       
        if($status == 'F'){
            $chamado->STATUS = 'E';

            $reabre->NM_CHAMADO = $nmChamado;
            $reabre->ID_USUARIO = $idUsuario;
            $reabre->DATA_REABERTURA = date('Y-m-d H:i:s');

            $reabre->save();

        }else{
            $chamado->STATUS = 'F';
        }
        //$chamado->STATUS = 'F' ;
        $chamado->DATA_ENCERRAMENTO = date('Y-m-d H:i:s');
        $inativado = $chamado->update();
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

    public function updatechamado(Request $request,$id){
                         
           
             $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
             $iddpto = Arr::pluck($data,'ID_DPTO')[0];
             
             $input = $request->all();
             $dpto = $input['dpto'];
             
             $chamado= Tab_chamados::findOrFail($id);
             
             $chamado->ID_DPTO = $request->dpto ;
             $chamado->PRIORIDADE = $request->prioridade ;
             
             // Verifica se o departamento do usuário é o mesmo do departamento que vai
             // atender o chamado. Se os departamentos forem iguais, o campo "VIEW" será¡
             // atualizado pra "S" se não ele atualiza pra "N".
             
             if($dpto == $iddpto){
             	$chamado->VIEW = 'S';
             }else{
             	$chamado->VIEW = 'N';
             }
             
             $update = $chamado->update();
             
             if($update){
                 Session::flash('success', true);
                 return back()->with([
                     'data'=> Arr::pluck($data,'USU_LOGIN')]);
              }else{
                 Session::flash('error', true);
                  return back()->with('fail','Opss..., Algo deu errado');
              }
    }
    
    public function geraPDF()
    {
    	
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
    	$id = Arr::pluck($data,'ID_PESSOA')[0];
    	$dpto = Arr::pluck($data,'ID_DPTO')[0];
    	$ano = date('Y');
    	//dd($ano);
    	
    	// Qtd Abertos no Mes
    	$aJan = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
    	$aFev = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
    	$aMar = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
    	$aAbr = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
    	$aMai = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
    	$aJun = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
    	$aJul = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
    	$aAgo = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
    	$aSet = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
    	$aOut = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
    	$aNov = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
    	$aDez = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
    	$abertos = [$aJan,$aFev,$aMar,$aAbr,$aMai,$aJun,$aJul,$aAgo,$aSet,$aOut,$aNov,$aDez];
    	// Qtd Fechados no Mes
    	$fJan = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
    	$fFev = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
    	$fMar = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
    	$fAbr = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
    	$fMai = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
    	$fJun = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
    	$fJul = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
    	$fAgo = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
    	$fSet = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
    	$fOut = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
    	$fNov = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
    	$fDez = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
    	$fechados = [$fJan,$fFev,$fMar,$fAbr,$fMai,$fJun,$fJul,$fAgo,$fSet,$fOut,$fNov,$fDez];
    	// Qtd EM Atendimento no Mes
    	$eJan = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
    	$eFev = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
    	$eMar = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
    	$eAbr = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
    	$eMai = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
    	$eJun = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
    	$eJul = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
    	$eAgo = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
    	$eSet = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
    	$eOut = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
    	$eNov = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
    	$eDez = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
    	$emAtendimento = [$eJan,$eFev,$eMar,$eAbr,$eMai,$eJun,$eJul,$eAgo,$eSet,$eOut,$eNov,$eDez];
    	//dd($emAtendimento);
    	$qtdSemAtendimmento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','A')->count();
    	$qtdMeusSemAtendimmento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','A')->where('ID_USUARIO',$id)->count();
    	
    	$qtdEncerrados = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','F')->count();
    	$qtdMeusEncerrados = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','F')->where('ID_USUARIO',$id)->count();
    	
    	$qtdEmAtendimento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','E')->count();
    	$qtdMeuEmAtendimento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','E')->where('ID_USUARIO',$id)->count();
    	
    	$qtdAberto = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->count();
    	$qtdTotal = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->count();
    	$qtdUsuarios = DB::table('tab_usuarios')->where('ID_DPTO',$dpto)->where('USU_STATUS','A')->count();
    	//dd($qtdEncerrados);
    	if($qtdEncerrados > 0 ){
    		$percente = ($qtdEncerrados * 100)/$qtdTotal ;
    	}else{
    		$percente = 0;
    	}
    	//dd(json_encode($percente));
    	
    		   		

    	$chamados = DB::table('tab_chamados as C')
    	->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
    	->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
    	->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
    	->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
    	->where('C.ID_DPTO',$dpto)
    	->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO','C.ID_CHAMADO',
    			'C.TITULO','C.DESCRICAO','DE.d_descricao','C.DATA_ABERTURA','C.STATUS','U.USU_LOGIN','U.ID_DPTO',
    			'P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
    			->orderBy('C.DATA_ABERTURA')
    			->get();
    	
    	
    	$depart = DB::table('tab_departamentos as d')
    	->join('tab_pessoas as P', 'd.ID_DPTO','P.ID_DPTO')
    	->where('d.ID_DPTO',$dpto)
    	->select('d.DESCRICAO')
    	->groupby('d.DESCRICAO')->get();
    	
    	$setor = Arr::pluck($depart,'DESCRICAO')[0];
    	    	
    	//dd($setor);
    	$qtdDpto = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->count();
    	$qtdfechados = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->count();
    	$qtdEmAtendimento = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->count();
    	//dd($abertos,$fechados,$emAtendimento);
    	return view('painel.relatorio-demandas')->with([
    			
    			'abertosDpto'=>($qtdDpto),
    			'qtdAbertos'=>($qtdAberto),
    			'qtdFechados'=>($qtdfechados),
    			'atendimento'=>($qtdEmAtendimento),
    			'chamados'=>($chamados),
    			'qtdChamados'=>($qtdAberto),
    			'qtdUsuarios'=>($qtdUsuarios),
    			'qtdSemAtendimmento'=>($qtdSemAtendimmento),
    			'qtdEncerrados'=>($qtdEncerrados),
    			'percente'=> number_format($percente, 2, ',', ''),
    			'setor'=>$setor,
    			'qtdEmAtendimento'=>($qtdEmAtendimento),
    			'anoCorrente'=>$ano,
    			// usa nos Graficos
    			
    			'abertos'=>($abertos),
    			'fechados'=>($fechados),
    			'emAtendimento'=>($emAtendimento),
    	]);
    }
    
    public function relatorios(){
    	

    	
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
    	$nivel =  Arr::pluck($data,'USU_NIVEL')[0];
    	$dptos = DB::table('tab_departamentos')->get();
    	
    	
    	return view('painel/create-relatorios')->with([
    			
    			'data' => Arr::pluck($data,'USU_LOGIN'),
    			'iduser'=>Arr::pluck($data,'ID_USUARIO'),
    			'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
    			'imagem' =>Arr::pluck($data,'FOTO'),
    			'nivel'=> $nivel,
    			'dptos'=>$dptos,    			
    			
    	]);
    	
    }
    
    public function geraGraficos(Request $request){
    	
    	$ano = date('Y') ;
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
    	$id = Arr::pluck($data,'ID_PESSOA')[0];
    	//$dpto = Arr::pluck($data,'ID_DPTO')[0];
    	$dpto = $request->dpto;
    	
    	
    	// Qtd Abertos no Mes
    	$aJan = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
    	$aFev = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
    	$aMar = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
    	$aAbr = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
    	$aMai = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
    	$aJun = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
    	$aJul = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
    	$aAgo = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
    	$aSet = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
    	$aOut = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
    	$aNov = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
    	$aDez = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
    	$abertos = [$aJan,$aFev,$aMar,$aAbr,$aMai,$aJun,$aJul,$aAgo,$aSet,$aOut,$aNov,$aDez];
    	// Qtd Fechados no Mes
    	$fJan = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
    	$fFev = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
    	$fMar = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
    	$fAbr = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
    	$fMai = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
    	$fJun = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
    	$fJul = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
    	$fAgo = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
    	$fSet = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
    	$fOut = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
    	$fNov = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
    	$fDez = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
    	$fechados = [$fJan,$fFev,$fMar,$fAbr,$fMai,$fJun,$fJul,$fAgo,$fSet,$fOut,$fNov,$fDez];
    	// Qtd EM Atendimento no Mes
    	$eJan = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
    	$eFev = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
    	$eMar = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
    	$eAbr = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
    	$eMai = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
    	$eJun = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
    	$eJul = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
    	$eAgo = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
    	$eSet = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
    	$eOut = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
    	$eNov = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
    	$eDez = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
    	$emAtendimento = [$eJan,$eFev,$eMar,$eAbr,$eMai,$eJun,$eJul,$eAgo,$eSet,$eOut,$eNov,$eDez];
    	//dd($emAtendimento);
    	$qtdSemAtendimmento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','A')->count();
    	$qtdMeusSemAtendimmento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','A')->where('ID_USUARIO',$id)->count();
    	
    	$qtdEncerrados = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','F')->count();
    	$qtdMeusEncerrados = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','F')->where('ID_USUARIO',$id)->count();
    	
    	$qtdEmAtendimento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','E')->count();
    	$qtdMeuEmAtendimento = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','E')->where('ID_USUARIO',$id)->count();
    	
    	$qtdAberto = DB::table('tab_chamados')->where('STATUS','A')->where('ID_DPTO',$dpto)->count();
    	$qtdTotal = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->count();
    	$qtdUsuarios = DB::table('tab_usuarios')->where('ID_DPTO',$dpto)->where('USU_STATUS','A')->count();
    	//dd($qtdEncerrados);
    	if($qtdEncerrados > 0 ){
    		$percente = ($qtdEncerrados * 100)/$qtdTotal ;
    	}else{
    		$percente = 0;
    	}
    	
    	
    	$qtdChamados = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->count();
    	$chamados = DB::table('tab_chamados as C')
    	->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
    	->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
    	->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
    	->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
    	->where('C.ID_DPTO',$dpto)
    	->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO','C.ID_CHAMADO',
    			'C.TITULO','C.DESCRICAO','DE.d_descricao','C.DATA_ABERTURA','C.STATUS','U.USU_LOGIN',
    			'P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
    			->orderBy('C.DATA_ABERTURA')
    			->get();
    			
    			
        $depart = DB::table('tab_departamentos as d')
        ->where('d.ID_DPTO',$dpto)
        ->select('d.DESCRICAO')
        ->groupby('d.DESCRICAO')->get();
        
        //dd( Arr::pluck($depart,'DESCRICAO')[0]);
        
        $setor = Arr::pluck($depart,'DESCRICAO')[0];
        
        $qtdDpto = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->count();
        $qtdfechados = DB::table('tab_chamados')->where('STATUS','F')->where('ID_DPTO',$dpto)->count();
        $qtdEmAtendimento = DB::table('tab_chamados')->where('STATUS','E')->where('ID_DPTO',$dpto)->count();
        //dd($qtdChamados,$fechados,$emAtendimento);
        //dd(Arr::pluck($data,'ID_PESSOA'));
        return view('painel.graficos-demandas')->with([
                
                'abertosDpto'=>($qtdDpto),
                'qtdAbertos'=>($qtdAberto),
                'qtdFechados'=>($qtdfechados),
                'atendimento'=>($qtdEmAtendimento),
                'chamados'=>($chamados),
                'qtdChamados'=>($qtdAberto),
                'qtdUsuarios'=>($qtdUsuarios),
                'qtdSemAtendimmento'=>($qtdSemAtendimmento),
                'qtdEncerrados'=>($qtdEncerrados),
                'percente'=> number_format($percente, 2, ',', ''),
                'setor'=>$setor,
                'qtdEmAtendimento'=>($qtdEmAtendimento),
                'anoCorrente'=>$ano,
                'abertos'=>($abertos),// usa nos Graficos
                'fechados'=>($fechados),// usa nos Graficos
                'emAtendimento'=>($emAtendimento),// usa nos Graficos
                
        ]);
    }
    
    public function pdfDescricao($idchamado){
    	
    	$ano = date('Y') ;
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
    	$dpto = Arr::pluck($data,'ID_DPTO')[0];
    	
    	$chamado = DB::table('tab_chamados as C')
    	->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
    	->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
    	->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
    	->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
    	->where('C.ID_CHAMADO',$idchamado)
    	//->where('C.ID_DPTO',$dpto)
    	->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO','C.ID_CHAMADO',
    			'C.TITULO','C.DESCRICAO','DE.d_descricao','C.DATA_ABERTURA','C.STATUS','U.USU_LOGIN','U.ID_DPTO',
    			'P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
    			->orderBy('C.DATA_ABERTURA')
    			->get();
    	
    	$depart = DB::table('tab_departamentos as d')
    		->where('d.ID_DPTO',$dpto)
    		->select('d.DESCRICAO')
    		->groupby('d.DESCRICAO')->get();
    	
    	$numChamado = Arr::pluck($chamado,'NM_CHAMADO')[0];
    	$titulo = Arr::pluck($chamado,'d_descricao')[0];
    	$descricao = Arr::pluck($chamado,'DESCRICAO')[0];
    	
    	$chamado = Tab_chamados::findOrFail($idchamado);
    	$chamado->PRINT = 1;
    	
    	// FAZ O UPDATE NA TABELA TAB_CHAMADOS, NO CAMPO PRINT
    	$chamado->update();
    	
    	return view('painel.pdf-descricao-chamado')->with([
    					
    			'titulo'=>($titulo),
    			'descricao'=>($descricao),
    			'numChamado'=>($numChamado),
    					
    	]);
    	
    }
    public function chamadosFinalizados(){
    	
    	
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
    	$dpto = Arr::pluck($data,'ID_DPTO')[0];
    	$nivel =  Arr::pluck($data,'USU_NIVEL')[0];
    	
    	
    	$chamados = DB::table('tab_chamados as C')
    	->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
    	->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
    	->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
    	->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
    	->where('C.ID_DPTO',$dpto)
    	->where('C.STATUS','F')
    	->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO','C.ID_CHAMADO',
    			'C.TITULO','C.DESCRICAO','DE.d_descricao','C.DATA_ABERTURA','C.DATA_ENCERRAMENTO','C.STATUS','U.USU_LOGIN',
    			'P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
    			->orderBy('C.DATA_ABERTURA')
    			->get();
    	
    			//dd($chamados);
    			
    			$inter = DB::table('tab_interacao_chamados as I')
    			->join('tab_chamados as C','C.ID_CHAMADO', 'I.ID_CHAMADO')
    			->leftJoin('tab_usuarios as U','U.ID_USUARIO','C.ID_USUARIO')
    			->join('tab_pessoas as P', 'P.ID_PESSOA','I.ID_USUARIO')
    			->select('P.ID_PESSOA','P.PESSOA_NOME','C.ID_CHAMADO','C.NM_CHAMADO','C.TITULO',
    					'C.DESCRICAO','I.ID_INTERACAO_CHAMADO','I.INT_DESC_CHAMADO')
    					->get();
    					
    	$imgs = DB::table('tab_chamados as C')
    	->leftJoin('tab_imagens as I','C.NM_CHAMADO','I.NM_CHAMADO')
    	->select('C.NM_CHAMADO','I.IMAGEM')
    	->get();
    	$dptos = DB::table('tab_departamentos')->get();
    	return view('painel/lista-chamados-encerrados')->with([
    				'chamados'=>$chamados,
    				'imgs'=>$imgs,
    				'int'=>$inter,
    				'data' => Arr::pluck($data,'USU_LOGIN'),
    				'iduser'=>Arr::pluck($data,'ID_USUARIO'),
    				'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
    				'imagem' =>Arr::pluck($data,'FOTO'),
    				'nivel'=> $nivel,
    				'dptos'=> $dptos,
    		]);
    	
    }
	
    public function relatorioFinalizados(){
    	
    	
    	$data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
    	$dpto = Arr::pluck($data,'ID_DPTO')[0];
    	$nivel =  Arr::pluck($data,'USU_NIVEL')[0];
    	$ano = date('Y') ;
    	
    	$chamados = DB::table('tab_chamados as C')
    	->join('tab_usuarios as U','C.ID_USUARIO','U.ID_PESSOA')
    	->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
    	->leftJoin('tab_pessoas as P','P.ID_PESSOA','C.ID_ATENDENTE')
    	->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
    	->where('C.ID_DPTO',$dpto)
    	->where('C.STATUS','F')
    	->select('C.ID_DPTO','D.DESCRICAO AS DEPARTAMENTO','C.NM_CHAMADO','C.ID_CHAMADO',
    			'C.TITULO','C.DESCRICAO','DE.d_descricao','C.DATA_ABERTURA','C.DATA_ENCERRAMENTO','C.STATUS','U.USU_LOGIN',
    			'P.PESSOA_NOME','C.PRIORIDADE','C.VIEW','C.PRINT')
    			->orderBy('C.DATA_ABERTURA')
    			->get();
    			
    			//dd($chamados);
    			
    	$inter = DB::table('tab_interacao_chamados as I')
    	->join('tab_chamados as C','C.ID_CHAMADO', 'I.ID_CHAMADO')
    	->leftJoin('tab_usuarios as U','U.ID_USUARIO','C.ID_USUARIO')
    	->join('tab_pessoas as P', 'P.ID_PESSOA','I.ID_USUARIO')
    	->select('P.ID_PESSOA','P.PESSOA_NOME','C.ID_CHAMADO','C.NM_CHAMADO','C.TITULO',
    	     	 'C.DESCRICAO','I.ID_INTERACAO_CHAMADO','I.INT_DESC_CHAMADO')
    	->get();
    	
    	$depart = DB::table('tab_departamentos as d')
    	->where('d.ID_DPTO',$dpto)
    	->select('d.DESCRICAO')
    	->groupby('d.DESCRICAO')->get();
    	
    	//dd( Arr::pluck($depart,'DESCRICAO')[0]);
    	
    	$setor = Arr::pluck($depart,'DESCRICAO')[0];
    	
    	$qtdEncerrados = DB::table('tab_chamados')->where('ID_DPTO',$dpto)->where('STATUS','F')->count();
    	$imgs = DB::table('tab_chamados as C')
    	->leftJoin('tab_imagens as I','C.NM_CHAMADO','I.NM_CHAMADO')
    	->select('C.NM_CHAMADO','I.IMAGEM')
    	->get();
    	
    	$dptos = DB::table('tab_departamentos')->get();
    	return view('painel/relatorio-chamados-finalizados')->with([
    			'chamados'=>$chamados,
    			'imgs'=>$imgs,
    			'int'=>$inter,
    			'data' => Arr::pluck($data,'USU_LOGIN'),
    			'iduser'=>Arr::pluck($data,'ID_USUARIO'),
    			'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
    			'imagem' =>Arr::pluck($data,'FOTO'),
    			'nivel'=> $nivel,
    			'dptos'=> $dptos,
    			'setor'=>$setor,
    			'anoCorrente'=>$ano,
    		]);
    	
    }

}
