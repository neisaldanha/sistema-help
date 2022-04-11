<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tab_pessoas;
use App\Models\Departamentos;
use App\Models\Funcoes;
use App\Models\tab_usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Session;
use Validator;

class SendEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $users = DB::table('tab_pessoas')->where('PESSOA_STATUS','A')->get();
        //dd(Arr::pluck($data,'USU_NIVEL'));
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        return view('email/form-email')->with([
            'users' => $users,
            'iduser'=> Arr::pluck($data,'ID_USUARIO'),
            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
            'data'=>Arr::pluck($data,'USU_LOGIN'),
            'imagem' =>Arr::pluck($data,'FOTO'),
            'nivel'=>$nivel,
        ]);
    }

    function send(Request $request){

        $this->validate($request,[
            'nome'=>'required',
            'email'=>'required',
            'message'=>'required',
        ]);

       $send = Mail::to($request->email)
        //->cc('nei.saldanha@hotmail.com')
        ->send(new SendMail($request));

       Session::flash('success', true);
            return back()->with([
                'success','E-mail enviado com sucesso',
                
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
        //Validate requests
        $input = $request->all();
        //dd($input);
        $rules = [
            'nome'=>'required',
            'email'=>'required',
            'message'=>'required',
        ];

        $nomes = [
            'nome'=>'Nome',
            'email'=>'Descrição',
            'message'=>'Mensagem',
            
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
        //dd('chegou no store');
    
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
